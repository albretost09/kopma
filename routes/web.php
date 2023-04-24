<?php

use App\Http\Controllers\Anggota;
use App\Http\Controllers\Pengurus;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::get('login', [Anggota\Auth\LoginController::class, 'index'])->name('login');
Route::post('login', [Anggota\Auth\LoginController::class, 'authenticate'])->name('login');
Route::prefix('recovery-password')->name('recovery-password.')->group(function () {
    Route::get('', [Anggota\Auth\RecoverPasswordController::class, 'index'])->name('index');
    Route::post('', [Anggota\Auth\RecoverPasswordController::class, 'sendEmail'])->name('send-email');
    Route::get('{token}', [Anggota\Auth\RecoverPasswordController::class, 'reset'])->name('reset');
    Route::post('{token}', [Anggota\Auth\RecoverPasswordController::class, 'resetPassword'])->name('reset-password');
});


Route::middleware('auth')->group(function () {
    Route::get('', [Anggota\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [Anggota\Auth\LoginController::class, 'logout'])->name('logout');

    Route::name('anggota.')->group(function () {
        Route::prefix('profil')->name('profil.')->group(function () {
            Route::get('', [Anggota\Profil\ProfilController::class, 'index'])->name('index');
            Route::put('ubah', Anggota\Profil\UbahProfilController::class)->name('ubah-profil');
            Route::put('ubah-password', Anggota\Profil\UbahPasswordController::class)->name('ubah-password');
        });

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

// Pengurus
Route::prefix('pengurus')->name('pengurus.')->group(
    function () {
        Route::get('login', [Pengurus\Auth\LoginController::class, 'index'])->name('login');
        Route::post('login', [Pengurus\Auth\LoginController::class, 'authenticate'])->name('login');
        Route::prefix('recovery-password')->name('recovery-password.')->group(function () {
            Route::get('', [Pengurus\Auth\RecoverPasswordController::class, 'index'])->name('index');
            Route::post('', [Pengurus\Auth\RecoverPasswordController::class, 'sendEmail'])->name('send-email');
            Route::get('{token}', [Pengurus\Auth\RecoverPasswordController::class, 'reset'])->name('reset');
            Route::post('{token}', [Pengurus\Auth\RecoverPasswordController::class, 'resetPassword'])->name('reset-password');
        });

        Route::middleware(['auth', 'pengurus'])->group(function () {
            Route::get('', [Pengurus\Dashboard\DashboardController::class, 'index'])->name('dashboard');
            Route::post('logout', [Pengurus\Auth\LoginController::class, 'logout'])->name('logout');
            Route::prefix('profil')->name('profil.')->group(function () {
                Route::get('', [Pengurus\Profil\ProfilController::class, 'index'])->name('index');
                Route::put('ubah', Pengurus\Profil\UbahProfilController::class)->name('ubah-profil');
                Route::put('ubah-password', Pengurus\Profil\UbahPasswordController::class)->name('ubah-password');
            });

            Route::get('anggota/{id}/status', [Pengurus\AnggotaController::class, 'status'])->name('anggota.status');
            Route::put('anggota/{id}/status', [Pengurus\AnggotaController::class, 'ubahStatus'])->name('anggota.ubah-status');
            Route::resource('anggota', Pengurus\AnggotaController::class);
            Route::get('kas/data', [Pengurus\KasController::class, 'data'])->name('kas.data');
            Route::resource('kas', Pengurus\KasController::class);

            Route::prefix('setor-simpanan')->name('setor-simpanan.')->group(function () {
                Route::get('', [Pengurus\Simpanan\SetorSimpananController::class, 'index'])->name('index');
                Route::post('', [Pengurus\Simpanan\SetorSimpananController::class, 'store'])->name('store');
            });

            Route::get('riwayat-simpanan', [Pengurus\Simpanan\RiwayatSimpananController::class, 'index'])->name('riwayat-simpanan.index');
        });
    }
);

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [Admin\Auth\LoginController::class, 'index'])->name('login');
    Route::post('login', [Admin\Auth\LoginController::class, 'authenticate'])->name('login');
    Route::prefix('recovery-password')->name('recovery-password.')->group(function () {
        Route::get('', [Admin\Auth\RecoverPasswordController::class, 'index'])->name('index');
        Route::post('', [Admin\Auth\RecoverPasswordController::class, 'sendEmail'])->name('send-email');
        Route::get('{token}', [Admin\Auth\RecoverPasswordController::class, 'reset'])->name('reset');
        Route::post('{token}', [Admin\Auth\RecoverPasswordController::class, 'resetPassword'])->name('reset-password');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('', [Admin\Dashboard\DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [Admin\Auth\LoginController::class, 'logout'])->name('logout');
        Route::prefix('profil')->name('profil.')->group(function () {
            Route::get('', [Admin\Profil\ProfilController::class, 'index'])->name('index');
            Route::put('ubah', Admin\Profil\UbahProfilController::class)->name('ubah-profil');
            Route::put('ubah-password', Admin\Profil\UbahPasswordController::class)->name('ubah-password');
        });

        Route::get('anggota/{id}/status', [Admin\AnggotaController::class, 'status'])->name('anggota.status');
        Route::put('anggota/{id}/status', [Admin\AnggotaController::class, 'ubahStatus'])->name('anggota.ubah-status');
        Route::resource('anggota', Admin\AnggotaController::class);
        Route::get('pengurus/{id}/status', [Admin\PengurusController::class, 'status'])->name('pengurus.status');
        Route::put('pengurus/{id}/status', [Admin\PengurusController::class, 'ubahStatus'])->name('pengurus.ubah-status');
        Route::resource('pengurus', Admin\PengurusController::class);
        Route::resource('pengawas', Admin\PengawasController::class);
        Route::get('kas/data', [Admin\KasController::class, 'data'])->name('kas.data');
        Route::resource('kas', Admin\KasController::class);
        Route::resource('simpanan', Admin\Simpanan\SimpananController::class);
        Route::get('permintaan-penarikan/{id}/status', [Admin\Simpanan\PermintaanPenarikanSimpananController::class, 'changeStatus'])->name('permintaan-penarikan.ubah-status');
        Route::resource('permintaan-penarikan', Admin\Simpanan\PermintaanPenarikanSimpananController::class);
    });
});
