<?php

use App\Http\Controllers\Api\UrlApiController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function () {
    if (config('shorturl.can_register_via_api')) {
        Route::post('register', 'register');
    }
    Route::post('login', 'login');
});

Route::apiResource('url',UrlApiController::class)
    ->middleware('auth:sanctum');


