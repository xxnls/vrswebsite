<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('index');
});

// Vehicle Routes
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/vehicles/{id}', [VehicleController::class, 'show']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Dashboard Route
Route::middleware('auth.token')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
