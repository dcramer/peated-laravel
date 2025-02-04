<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthGoogleController;
use App\Http\Controllers\Api\BottleController;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\VersionController;
use Illuminate\Support\Facades\Route;

Route::get('/auth', [AuthController::class, 'show']);
Route::post('/auth/google', [AuthGoogleController::class, 'callback']);
Route::get('/stats', [StatsController::class, 'index']);
Route::get('/version', [VersionController::class, 'show']);
Route::get('/bottles', [BottleController::class, 'index']);
