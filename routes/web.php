<?php

use App\Http\Controllers\Route\RouterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Login');
});

Route::middleware(['auth'])->group(function () {

    Route::prefix('superAdmin')->group(function () {
        Route::get('/', [RouterController::class, 'SuperAdminIndex'])->name('superAdmin.index');
    });
});
