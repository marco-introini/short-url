<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UrlApiController;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::apiResource('url',UrlApiController::class)
    ->middleware('auth:sanctum');


