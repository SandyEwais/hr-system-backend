<?php

use Illuminate\Support\Facades\Route;


Route::prefix('v1')
    ->middleware(['auth:sanctum', 'role:employee'])
    ->group(function () {

    });