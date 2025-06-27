<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('postloginusr', [AuthController::class, 'login']);
Route::any('logout', [AuthController::class, 'signout'])->name('logout');

Route::middleware(['auth'])->group(function () {
Route::get('adminhome', [AdminController::class, 'pengurusanBilik'])->name('admin.bilik');

Route::prefix('bilik')->group(function () {
    Route::post('/', [AdminController::class, 'storeBilik'])->name('bilik.store');
    Route::put('/{id}', [AdminController::class, 'updateBilik'])->name('bilik.update');
    Route::delete('/{id}', [AdminController::class, 'destroyBilik'])->name('bilik.destroy');
});

Route::prefix('staff')->group(function () {
    Route::get('/', [AdminController::class, 'pengurusanStaff'])->name('staff.index');
    Route::post('/', [AdminController::class, 'storeStaff'])->name('staff.store');
    Route::put('/{id}', [AdminController::class, 'updateStaff'])->name('staff.update');
    Route::delete('/{id}', [AdminController::class, 'destroyStaff'])->name('staff.destroy');
});

Route::prefix('doctor')->group(function () {
    Route::get('/', [AdminController::class, 'pengurusanDoctor'])->name('doctor.index');
    Route::post('/', [AdminController::class, 'storeDoctor'])->name('doctor.store');
    Route::put('/{id}', [AdminController::class, 'updateDoctor'])->name('doctor.update');
    Route::delete('/{id}', [AdminController::class, 'destroyDoctor'])->name('doctor.destroy');
});

Route::get('/loginlogs', [AdminController::class, 'loginlogs'])->name('loginlogs');
});
