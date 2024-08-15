<?php

use App\Http\Controllers\Route\RouterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Login');
});
Route::get('/login', [RouterController::class, 'Login'])->name('login');

Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::prefix('superAdmin')->group(function () {
            Route::get('/', [RouterController::class, 'SuperAdminIndex'])->name('superAdmin.index');
            Route::get('/service-centers', [RouterController::class, 'SuperAdminServiceCenters'])->name('superAdmin.serviceCenters');
        });
    });

});
