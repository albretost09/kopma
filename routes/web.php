<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Anggota;
use App\Http\Controllers\Pengurus;
use App\Http\Controllers\Pengawas;
use Illuminate\Support\Facades\Route;

Route::get('login', [Anggota\Auth\LoginController::class, 'index'])->name('login');
Route::post('login', [Anggota\Auth\LoginController::class, 'authenticate'])->name('login');
Route::get('register', [Anggota\Auth\RegisterController::class, 'index'])->name('register.index');
Route::post('register', [Anggota\Auth\RegisterController::class, 'store'])->name('register.store');
Route::prefix('recovery-password')->name('recovery-password.')->group(function () {
    Route::get('', [Anggota\Auth\RecoverPasswordController::class, 'index'])->name('index');
    Route::post('', [Anggota\Auth\RecoverPasswordController::class, 'sendEmail'])->name('send-email');
    Route::get('{token}', [Anggota\Auth\RecoverPasswordController::class, 'reset'])->name('reset');
    Route::post('{token}', [Anggota\Auth\RecoverPasswordController::class, 'resetPassword'])->name('reset-password');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [Anggota\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [Anggota\Auth\LoginController::class, 'logout'])->name('logout');

    Route::name('anggota.')->group(function () {
        Route::prefix('profil')->name('profil.')->group(function () {
            Route::get('', [Anggota\Profil\ProfilController::class, 'index'])->name('index');
            Route::put('ubah', Anggota\Profil\UbahProfilController::class)->name('ubah-profil');
            Route::put('ubah-kontak', Anggota\Profil\UbahKontakController::class)->name('ubah-kontak');
            Route::put('ubah-password', Anggota\Profil\UbahPasswordController::class)->name('ubah-password');
            Route::post('pengunduran-diri', Anggota\Profil\PengunduranDiriController::class)->name('pengunduran-diri');
            Route::get('pengunduran-diri/cetak', Anggota\Profil\CetakPengunduranDiriController::class)->name('pengunduran-diri.cetak');
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
                Route::put('ubah-kontak', Pengurus\Profil\UbahKontakController::class)->name('ubah-kontak');
                Route::put('ubah-password', Pengurus\Profil\UbahPasswordController::class)->name('ubah-password');
            });

            Route::get('anggota/{id}/status', [Pengurus\AnggotaController::class, 'status'])->name('anggota.status');
            Route::put('anggota/{id}/status', [Pengurus\AnggotaController::class, 'ubahStatus'])->name('anggota.ubah-status');
            Route::resource('anggota', Pengurus\AnggotaController::class);
            Route::get('kas/data', [Pengurus\KasController::class, 'data'])->name('kas.data');
            Route::resource('kas', Pengurus\KasController::class);
            Route::get('simpanan/data', [Pengurus\Simpanan\SimpananController::class, 'data'])->name('simpanan.data');
            Route::get('simpanan/{id}/status', [Pengurus\Simpanan\SimpananController::class, 'ubahStatus'])->name('simpanan.ubah-status');
            Route::resource('simpanan', Pengurus\Simpanan\SimpananController::class);

            Route::prefix('setor-simpanan')->name('setor-simpanan.')->group(function () {
                Route::get('', [Pengurus\Simpanan\SetorSimpananController::class, 'index'])->name('index');
                Route::post('', [Pengurus\Simpanan\SetorSimpananController::class, 'store'])->name('store');
            });

            Route::prefix('tarik-simpanan')->name('tarik-simpanan.')->group(function () {
                Route::get('', [Pengurus\Simpanan\TarikSimpananController::class, 'index'])->name('index');
                Route::post('', [Pengurus\Simpanan\TarikSimpananController::class, 'store'])->name('store');
            });

            Route::get('riwayat-simpanan', [Pengurus\Simpanan\RiwayatSimpananController::class, 'index'])->name('riwayat-simpanan.index');

            Route::get('laporan', [Pengurus\Laporan\LaporanController::class, 'index'])->name('laporan.index');
            Route::prefix('laporan-shu')->name('laporan-shu.')->group(function () {
                Route::get('cetak', [Pengurus\Laporan\LaporanSHUController::class, 'cetak'])->name('cetak');
                Route::post('cetak-pdf', [Pengurus\Laporan\LaporanSHUController::class, 'cetakPDF'])->name('cetak-pdf');
            });
            Route::prefix('laporan-kas')->name('laporan-kas.')->group(function () {
                Route::get('cetak', [Pengurus\Laporan\LaporanKasController::class, 'cetak'])->name('cetak');
                Route::post('cetak-pdf', [Pengurus\Laporan\LaporanKasController::class, 'cetakPDF'])->name('cetak-pdf');
            });
            Route::prefix('laporan-simpanan')->name('laporan-simpanan.')->group(function () {
                Route::get('cetak', [Pengurus\Laporan\LaporanSimpananController::class, 'cetak'])->name('cetak');
                Route::post('cetak-pdf', [Pengurus\Laporan\LaporanSimpananController::class, 'cetakPDF'])->name('cetak-pdf');
            });
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
        Route::get('simpanan/data', [Admin\Simpanan\SimpananController::class, 'data'])->name('simpanan.data');
        Route::get('simpanan/{id}/status', [Admin\Simpanan\SimpananController::class, 'ubahStatus'])->name('simpanan.ubah-status');
        Route::resource('simpanan', Admin\Simpanan\SimpananController::class);
        Route::post('permintaan-penarikan/{id}/status', [Admin\Simpanan\PermintaanPenarikanSimpananController::class, 'ubahStatus'])->name('permintaan-penarikan.ubah-status');
        Route::post('permintaan-penarikan/data', [Admin\Simpanan\PermintaanPenarikanSimpananController::class, 'data'])->name('permintaan-penarikan.data');
        Route::resource('permintaan-penarikan', Admin\Simpanan\PermintaanPenarikanSimpananController::class);
        Route::resource('pengunduran-diri', Admin\PengunduranDiri\PengunduranDiriController::class);
        Route::get('validasi-pengunduran-diri/{id}', [Admin\PengunduranDiri\ValidasiPengunduranDiriController::class, 'show'])->name('validasi-pengunduran-diri.show');
        Route::get('validasi-pengunduran-diri/ubah-status/{id}', [Admin\PengunduranDiri\ValidasiPengunduranDiriController::class, 'store'])->name('validasi-pengunduran-diri.store');

        Route::prefix('pembagian-shu')->name('pembagian-shu.')->group(function () {
            Route::get('', [Admin\SHU\PembagianSHUController::class, 'index'])->name('index');
            Route::post('', [Admin\SHU\PembagianSHUController::class, 'store'])->name('store');
        });

        Route::get('laporan', [Admin\Laporan\LaporanController::class, 'index'])->name('laporan.index');
        Route::prefix('laporan-shu')->name('laporan-shu.')->group(function () {
            Route::get('cetak', [Admin\Laporan\LaporanSHUController::class, 'cetak'])->name('cetak');
            Route::post('cetak-pdf', [Admin\Laporan\LaporanSHUController::class, 'cetakPDF'])->name('cetak-pdf');
        });
        Route::prefix('laporan-kas')->name('laporan-kas.')->group(function () {
            Route::get('cetak', [Admin\Laporan\LaporanKasController::class, 'cetak'])->name('cetak');
            Route::post('cetak-pdf', [Admin\Laporan\LaporanKasController::class, 'cetakPDF'])->name('cetak-pdf');
        });
        Route::prefix('laporan-simpanan')->name('laporan-simpanan.')->group(function () {
            Route::get('cetak', [Admin\Laporan\LaporanSimpananController::class, 'cetak'])->name('cetak');
            Route::post('cetak-pdf', [Admin\Laporan\LaporanSimpananController::class, 'cetakPDF'])->name('cetak-pdf');
        });
    });
});

// Pengawas
Route::prefix('pengawas')->name('pengawas.')->group(
    function () {
        Route::get('login', [Pengawas\Auth\LoginController::class, 'index'])->name('login');
        Route::post('login', [Pengawas\Auth\LoginController::class, 'authenticate'])->name('login');
        Route::prefix('recovery-password')->name('recovery-password.')->group(function () {
            Route::get('', [Pengawas\Auth\RecoverPasswordController::class, 'index'])->name('index');
            Route::post('', [Pengawas\Auth\RecoverPasswordController::class, 'sendEmail'])->name('send-email');
            Route::get('{token}', [Pengawas\Auth\RecoverPasswordController::class, 'reset'])->name('reset');
            Route::post('{token}', [Pengawas\Auth\RecoverPasswordController::class, 'resetPassword'])->name('reset-password');
        });

        Route::middleware(['auth:admin', 'pengawas'])->group(
            function () {
                Route::get('', [Pengawas\Dashboard\DashboardController::class, 'index'])->name('dashboard');
                Route::post('logout', [Pengawas\Auth\LoginController::class, 'logout'])->name('logout');
                Route::prefix('profil')->name('profil.')->group(function () {
                    Route::get('', [Pengawas\Profil\ProfilController::class, 'index'])->name('index');
                    Route::put('ubah', Pengawas\Profil\UbahProfilController::class)->name('ubah-profil');
                    Route::put('ubah-password', Pengawas\Profil\UbahPasswordController::class)->name('ubah-password');
                });

                Route::get('laporan', [Pengawas\Laporan\LaporanController::class, 'index'])->name('laporan.index');
                Route::prefix('laporan-shu')->name('laporan-shu.')->group(function () {
                    Route::get('cetak', [Pengawas\Laporan\LaporanSHUController::class, 'cetak'])->name('cetak');
                    Route::post('cetak-pdf', [Pengawas\Laporan\LaporanSHUController::class, 'cetakPDF'])->name('cetak-pdf');
                });
                Route::prefix('laporan-kas')->name('laporan-kas.')->group(function () {
                    Route::get('cetak', [Pengawas\Laporan\LaporanKasController::class, 'cetak'])->name('cetak');
                    Route::post('cetak-pdf', [Pengawas\Laporan\LaporanKasController::class, 'cetakPDF'])->name('cetak-pdf');
                });
                Route::prefix('laporan-simpanan')->name('laporan-simpanan.')->group(function () {
                    Route::get('cetak', [Pengawas\Laporan\LaporanSimpananController::class, 'cetak'])->name('cetak');
                    Route::post('cetak-pdf', [Pengawas\Laporan\LaporanSimpananController::class, 'cetakPDF'])->name('cetak-pdf');
                });
            }
        );
    }
);

Route::view('/', 'layouts.front');
