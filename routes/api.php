<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\VersionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/stats', [StatsController::class, 'index']);
Route::get('/version', [VersionController::class, 'show']);

