<?php

use App\Http\Controllers\Admin\AuthContoller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Admin Auth Routes (NO sanctum)
    |--------------------------------------------------------------------------
    */
    Route::prefix('auth')
        ->controller(AuthContoller::class)
        ->group(function () {
            Route::post('/login', 'login');
        });

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes (Sanctum + Role)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:admin'])
        ->group(function () {

            //
        });
});