<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiResponse
{
    public static function success($result, $message = '', $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result
        ];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }

    public static function error($e = null, $defaultMessage = "Something went wrong!", $code = 500)
    {
        Log::error($e);
        $status = $code;
        $message = $defaultMessage;

        if (!is_null($e)) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
                return response()->json([
                    'success' => false,
                    'message' => 'JWT error occured',
                    'errors' => $e->getMessage(),
                ], 401);
            } elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
                $status = 401;
                $message = 'Unauthenticated';
            } elseif ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                $status = 403;
                $message = 'Unauthorized';
            } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                $status = 404;
                $message = 'Not Found';
            } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                $status = 405;
                $message = 'Method Not Allowed';
            } elseif ($e instanceof \Illuminate\Database\QueryException) {
                if ($e->getCode() === '23000') {
                    $status = 409;
                    $message = 'Duplicate Entry';
                } else {
                    $message = 'Database error';
                }
            } elseif ($e instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ], 422);
            } elseif ($e instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
                $status = 429;
                $message = 'Too Many Requests';
            } elseif ($e instanceof \Illuminate\Session\TokenMismatchException) {
                $status = 419;
                $message = 'CSRF token mismatch';
            } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                $status = $e->getStatusCode();
                $message = $e->getMessage();
            } elseif ($e instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException && str_contains($e->getMessage(), 'Route [login] not defined')) {
                $status = 401;
                $message = 'Unauthorized';
            }
        }

        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => [
                'type' => ($e != null ? get_class($e) : null),
            ],
        ], $status);

        /**
         * Throw an HttpResponseException for the error response
         * Somehow if we throw a new HttpResponseException when there is
         * already a JWTExeception, the new exception would not be executed.
         * Currently I am not sure whether this one only happen when there is a JWTException
         * or there are other exceptions that have the same behavior.
         * So, to make it safe, I will just return the above json data.
         */
        // throw new HttpResponseException(response()->json([
        //     'success' => false,
        //     'message' => $message,
        //     'error' => [
        //         'type' => ($e != null ? get_class($e) : null),
        //     ],
        // ], $status));
    }
}
