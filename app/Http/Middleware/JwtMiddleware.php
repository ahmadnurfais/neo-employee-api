<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\API\ApiResponse;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = auth('api')->payload();

        // Prevent 'unverified-user' tokens from accessing protected endpoints
        if ($token->get('role') === 'unverified-user') {
            return ApiResponse::error(null, 'You must verify your account before accessing this resource.', 403);
        }

        return $next($request);
    }
}
