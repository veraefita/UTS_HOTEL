<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ReservasiKamarController;
use App\Models\ReservasiKamar;

// Route untuk dashboard (hanya satu definisi route untuk '/')
Route::get('/', [WelcomeController::class, 'index'])->name('dashboard')->middleware('auth');

// Rute otentikasi
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Kamar Routes
    Route::group(['prefix' => 'kamar'], function() {
        Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
Route::post('/kamar/list', [KamarController::class, 'list'])->name('kamar.list');
Route::get('/kamar/create', [KamarController::class, 'create'])->name('kamar.create');
Route::post('/kamar', [KamarController::class, 'store'])->name('kamar.store');
Route::get('/kamar/{kamar_id}', [KamarController::class, 'show'])->name('kamar.show');
Route::get('/kamar/{kamar_id}/edit', [KamarController::class, 'edit'])->name('kamar.edit');
Route::put('/kamar/{kamar_id}', [KamarController::class, 'update'])->name('kamar.update');
Route::delete('/kamar/{kamar_id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
        //Route::resource('kamar', KamarController::class);
    
    });

    // Reservasi Kamar Routes
    Route::group(['prefix' => 'reservasi'], function() {
        Route::get('/', [ReservasiKamarController::class, 'index'])->name('reservasi.index');
        Route::get('/create', [ReservasiKamarController::class, 'create'])->name('reservasi.create');
        Route::post('/', [ReservasiKamarController::class, 'store'])->name('reservasi.store');
        Route::get('/list', [ReservasiKamarController::class, 'list'])->name('reservasi.list');
        Route::get('/{id}', [ReservasiKamarController::class, 'show'])->name('reservasi.show');
        Route::get('/{id}/edit', [ReservasiKamarController::class, 'edit'])->name('reservasi.edit');
        Route::put('/{id}', [ReservasiKamarController::class, 'update'])->name('reservasi.update');
        Route::delete('/{id}', [ReservasiKamarController::class, 'destroy'])->name('reservasi.destroy');
    });
});