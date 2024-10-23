<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5',
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:24',
            'gender' => 'required|in:Male,Female',
            'age' => 'nullable|integer|min:0|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $checkUser = User::where('email', $request->email)->first();

        if ($checkUser) {
            // Check if the user's 'is_verified' column is false
            if (!$checkUser->is_verified) {
                // Drop (delete) the user from the table
                // Since we will create a new one
                $checkUser->delete();
            }
        }

        $request->validate([
            'email' => 'unique:users,email',
        ]);

        // $request->validate([
        //     'email' => 'required|string|email|max:255|unique: users',
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         // $checkUser ? 'unique:users,email,' . $checkUser->id : 'unique:users'
        //         $checkUser ? "unique:users,email,{$checkUser->id}" : 'unique:users'
        //     ],
        // ]);

        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
        ]);

        if ($user) {
            $credentials = $request->only('email', 'password');
            $token = auth('api')->claims(['role' => 'unverified-user', 'purpose' => 'registration'])->setTTL(ttl: 5)->attempt($credentials); // Create the verification token that only valid for 5 minutes

            // Generate a 6-digit OTP that only valid for 5 minutes
            $otp = rand(100000, 999999);
            $expiresAt = Carbon::now()->addMinutes(5);

            // Save OTP to user_verifications table
            UserVerification::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'otp' => $otp,
                'expires_at' => $expiresAt,
            ]);

            // Send OTP to user's email
            Mail::to($user->email)->send(new OtpMail($otp, $request->name));
        }

        return ApiResponse::success(["user" => $user, "tempToken" => $token], "Account successfully created. Please verify it fiorst by entering the OTP code that was sent to your registration email. Check SPAM folder if you cannot find it in the inbox.", 201);
    }
}
