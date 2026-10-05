<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Api\UserController;

Route::apiResource('v1/users', UserController::class);