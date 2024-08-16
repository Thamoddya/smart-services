<?php

use App\Http\Controllers\Route\RouterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Login');
})->name('login');

Route::get('/login-process', [RouterController::class, 'Login'])->name('login-process');

Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::prefix('superAdmin')->group(function () {
            Route::get('/', [RouterController::class, 'SuperAdminIndex'])->name('superAdmin.index');
            Route::get('/service-centers', [RouterController::class, 'SuperAdminServiceCenters'])->name('superAdmin.serviceCenters');
        });
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [RouterController::class, 'AdminIndex'])->name('admin.index');
            Route::get('/customers', [RouterController::class, 'AdminCustomers'])->name('admin.customers');
            Route::get('/vehicles', [RouterController::class, 'AdminVehicles'])->name('admin.vehicles');
        });
    });


    Route::get('/logout', [RouterController::class, 'Logout'])->name('logout');
});
