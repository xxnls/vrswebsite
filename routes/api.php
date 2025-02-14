<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;

Route::get('/vehicles', [VehicleController::class, 'getVehicles']);
