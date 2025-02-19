<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RentalRequestController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RentalPlaceController;
use App\Http\Controllers\LicenseController;

Route::get('/', function () {
    return view('index');
})->name('home');

// Contact Route
Route::get('/contact', [RentalPlaceController::class, 'index'])->name('contact');

// Vehicle Routes
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');

// License Routes
Route::middleware('auth.token')->group(function () {
    Route::get('/upload-license', [LicenseController::class, 'showUploadForm'])->name('upload.form');
    Route::post('/upload-license', [LicenseController::class, 'uploadLicense'])->name('upload.license');
});

// Rental Request Routes
Route::middleware('auth.token')->group(function () {
    Route::get('/vehicles/{vehicleId}/rental-request', [RentalRequestController::class, 'create'])->name('rental-requests.create');
    Route::post('/rental-requests', [RentalRequestController::class, 'store'])->name('rental-requests.store');
    Route::get('/rental-requests', [RentalRequestController::class, 'indexCustomerRequests'])->name('rental-requests.index');
});

// Rentals Routes
Route::get('/rentals', [RentalController::class, 'indexCustomerRentals'])->name('rentals.index');

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
