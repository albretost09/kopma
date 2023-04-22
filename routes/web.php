<?php

use App\Http\Controllers\Anggota;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::get('login', [Anggota\Auth\LoginController::class, 'index'])->name('login');
Route::post('login', [Anggota\Auth\LoginController::class, 'authenticate'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('', [Anggota\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [Anggota\Auth\LoginController::class, 'logout'])->name('logout');

    Route::name('anggota.')->group(function () {
        Route::prefix('setor-simpanan')->name('setor-simpanan.')->group(function () {
            Route::get('', [Anggota\Simpanan\SetorSimpananController::class, 'index'])->name('index');
            Route::post('', [Anggota\Simpanan\SetorSimpananController::class, 'store'])->name('store');
        });

        Route::prefix('tarik-simpanan')->name('tarik-simpanan.')->group(function () {
            Route::get('', [Anggota\Simpanan\TarikSimpananController::class, 'index'])->name('index');
            Route::post('', [Anggota\Simpanan\TarikSimpananController::class, 'store'])->name('store');
        });

        Route::get('riwayat-simpanan', [Anggota\Simpanan\RiwayatSimpananController::class, 'index'])->name('riwayat-simpanan.index');
    });
});

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [Admin\Auth\LoginController::class, 'index'])->name('login');
    Route::post('login', [Admin\Auth\LoginController::class, 'authenticate'])->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('', [Admin\Dashboard\DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [Admin\Auth\LoginController::class, 'logout'])->name('logout');
        Route::prefix('profil')->name('profil.')->group(function () {
            Route::get('', [Admin\Profil\ProfilController::class, 'index'])->name('index');
            Route::put('ubah', Admin\Profil\UbahProfilController::class)->name('ubah-profil');
            Route::put('ubah-password', Admin\Profil\UbahPasswordController::class)->name('ubah-password');
        });

        Route::resource('anggota', Admin\AnggotaController::class);
        Route::resource('pengurus', Admin\PengurusController::class);
        Route::get('kas/data', [Admin\KasController::class, 'data'])->name('kas.data');
        Route::resource('kas', Admin\KasController::class);
        Route::resource('simpanan', Admin\Simpanan\SimpananController::class);
    });
});
