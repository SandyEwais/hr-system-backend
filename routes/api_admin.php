<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1/admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->controller()
    ->group(function () {

    });
