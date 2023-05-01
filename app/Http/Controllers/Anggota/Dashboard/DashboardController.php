<?php

namespace App\Http\Controllers\Anggota\Dashboard;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSaldo = Simpanan::query()
            ->where('pengguna_id', auth()->user()->id)
            ->where('status', 'DITERIMA')
            ->sum('jumlah') ?? 0;
        $simpanan = Simpanan::query()
            ->where('pengguna_id', auth()->user()->id)
            ->where('jenis_simpanan', 'Sukarela')
            ->where('status', 'DITERIMA');

        $jumlahSimpanan = $simpanan->sum('jumlah');

        $riwayatPenarikan = $simpanan->with('riwayatPenarikan')->get()->map(function ($item) {
            return $item->riwayatPenarikan;
        })->filter(function ($item) {
            return $item->count() > 0;
        })->flatten();

        $riwayatPenarikan = $riwayatPenarikan->map(function ($item) {
            return $item->status != 'DITOLAK' ? $item : null;
        })->filter(function ($item) {
            return $item != null;
        })->flatten();

        $jumlahRiwayatPenarikan = $riwayatPenarikan->sum('jumlah_penarikan');

        $jumlahSimpananSukarela = $jumlahSimpanan - $jumlahRiwayatPenarikan;
        $jumlahSimpananPokokWajib = Simpanan::query()
            ->where('pengguna_id', auth()->user()->id)
            ->where('status', 'DITERIMA')
            ->where('jenis_simpanan', 'Pokok')
            ->orWhere('jenis_simpanan', 'Wajib')
            ->sum('jumlah') ?? 0;

        $statusAnggota = auth()->user()->status;

        return view('pages.anggota.dashboard.dashboard', compact('jumlahSaldo', 'jumlahSimpananSukarela', 'jumlahSimpananPokokWajib', 'statusAnggota'));
    }
}
