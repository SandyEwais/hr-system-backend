<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Employee Auth Routes (NO sanctum)
    |--------------------------------------------------------------------------
    */
    Route::prefix('auth')
        // ->controller(AuthContoller::class)
        ->group(function () {
            // Route::post('login', 'login');
            // Route::post('signup', 'signup');
        });

    /*
    |--------------------------------------------------------------------------
    | Protected Employee Routes (Sanctum + Role)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:employee'])
        ->group(function () {

            // Route::get('profile', [UserController::class, 'profile']);

            // Route::prefix('users')
            //     ->controller(UserController::class)
            //     ->group(function () {
            //         Route::get('/', 'index');
            //         Route::post('/', 'store');
            //     });
        });
});