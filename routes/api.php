<?php

use App\Http\Controllers\Route\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/add-admin', [ApiController::class, 'StoreAdmin'])->name('store-admin');
Route::post('/get-admins', [ApiController::class, 'GetAdmins'])->name('get-admins');
Route::post('/add-service-center', [ApiController::class, 'StoreServiceCenter'])->name('store-service-center');

Route::post('/add-customer', [ApiController::class, 'StoreCustomer'])->name('store-customer');
Route::post('/get-vehicle-types', [ApiController::class, 'GetVehicleTypes'])->name('get-vehicle-types');
Route::post('/store-vehicle', [ApiController::class, 'StoreVehicle'])->name('store-vehicle');
