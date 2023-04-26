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
            ->sum('jumlah') ?? 0;
        $jumlahSimpananSukarela = Simpanan::query()
            ->where('pengguna_id', auth()->user()->id)
            ->where('jenis_simpanan', 'Sukarela')
            ->sum('jumlah') ?? 0;
        $jumlahSimpananPokokWajib = Simpanan::query()
            ->where('pengguna_id', auth()->user()->id)
            ->where('jenis_simpanan', 'Pokok')
            ->orWhere('jenis_simpanan', 'Wajib')
            ->sum('jumlah') ?? 0;

        return view('pages.anggota.dashboard.dashboard', compact('jumlahSaldo', 'jumlahSimpananSukarela', 'jumlahSimpananPokokWajib'));
    }
}
