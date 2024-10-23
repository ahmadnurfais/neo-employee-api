<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Models\UserVerification;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\API\ApiResponse;

class AuthController extends Controller
{
    /**
     * Login user and generate token
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return ApiResponse::error(null, 'Account does not exist. Try to register your account first,', 404);
        }
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return ApiResponse::error(null, 'Invalid credentials', 401);
        }
        return ApiResponse::success(["token" => $token]);
    }

    /**
     * Get authenticated user based on the token
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return ApiResponse::error(null, 'User not found', 404);
        }
        // return ApiResponse::success(compact('user'));
        return ApiResponse::success($user);
    }

    /**
     * Logout user (invalidate the token)
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return ApiResponse::success(null, "User logged out successfully");
    }

    /**
     * Refresh token
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return ApiResponse::success(["token" => JWTAuth::refresh(JWTAuth::getToken())]);
    }

    /**
     * User's account verification
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        // Check the 'purpose' and 'role' claim from the token payload
        $token_payload = auth('api')->payload();
        if ($token_payload->get('purpose') !== 'registration' || $token_payload->get('role' !== 'unverified-user')) {
            return ApiResponse::error(null, 'Invalid token for this action', 403);
        }

        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|min:6|max:6',
        ]);

        // Check if the user exist in the verification stage
        $findUser = User::where('email', $request->email)->first();
        if (!$findUser) {
            return ApiResponse::error(null, 'No verification record found for this user. Try to register your account first.', 404);
        }

        // Check whether the user is already verified or not
        if ($findUser->is_verified) {
            return ApiResponse::error(null, 'User is already verified', 400);
        }

        // Check if the user exist in the database and if the token valid for that user
        $user = auth('api')->user();
        if (!$user) {
            return ApiResponse::error(null, 'Failed to validate the user', 401);
        }

        // Get the user from verification entity
        $verification = UserVerification::where('user_id', $findUser->id)->orderBy('created_at', 'desc')->first();

        // Check the token expiration
        if (now()->greaterThan($verification->expires_at)) {
            return ApiResponse::error(null, 'OTP has expired', 400);
        }

        // Check OTP
        if ($verification->otp != $request->otp) {
            return ApiResponse::error(null, 'OTP code is wrong', 400);
        }

        // Update the user account to verified
        $user->is_verified = true;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return ApiResponse::success(null, 'User successfully verified');
    }
}
