<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DistillerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BottlerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/about', [AboutController::class, 'show'])->name('about');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
Route::get('/users/{username}', [UserController::class, 'show'])->name('users.show');
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('admin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');
Route::get('/friends', [FriendController::class, 'index'])->name('friends');
Route::get('/flights', [FlightController::class, 'index'])->name('flights');
Route::get('/bottles', [BottleController::class, 'index'])->name('bottles.index');
Route::get('/bottles/{bottle}', [BottleController::class, 'show'])->name('bottles.show');
Route::get('/locations', [LocationController::class, 'index'])->name('locations');
Route::get('/distillers', [DistillerController::class, 'index'])->name('distillers');
Route::get('/brands', [BrandController::class, 'index'])->name('brands');
Route::get('/bottlers', [BottlerController::class, 'index'])->name('bottlers');
