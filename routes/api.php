<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\JwtMiddleware;

Route::post('/auth/register', [UserController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']); // Require the token (expired) to be included in Authorization header

/**
 * All the JSON Web Tokens need to pass through the JwtMiddleware
 * before being sent to the endpoint.
 */
Route::group(['middleware' => ['api', JwtMiddleware::class]], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/get', [AuthController::class, 'getUser']);
});

/**
 * All the JSON Web Tokens can pass to the endpoint,
 * but usually a specific checker for token validation is required.
 * This is handled programmatically in the endpoint.
 */
Route::group(['middleware' => ['api']], function () {
    Route::post('/auth/verify', [AuthController::class, 'verify']);
});
