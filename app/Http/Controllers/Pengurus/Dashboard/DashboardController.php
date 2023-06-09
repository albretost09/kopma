<?php

namespace App\Http\Controllers\Pengurus\Dashboard;

use App\Models\Kas;
use App\Models\User;
use App\Models\Pengguna;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\PengunduranDiri;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAnggota = Pengguna::where('role', 'ANGGOTA')->count() ?? 0;
        $kasKopma = (Kas::where('jenis', 'Masuk')->sum('jumlah') - Kas::where('jenis', 'Keluar')->sum('jumlah')) ?? 0;
        $idPengunduranDiri = PengunduranDiri::where('status', 'DITERIMA')->pluck('pengguna_id');
        $totalSimpanan = Simpanan::where('status', 'DITERIMA')
            ->whereNotIn('pengguna_id', $idPengunduranDiri)
            ->sum('jumlah') ?? 0;
        $dataChart = [
            'pemasukan' => Kas::where('jenis', 'Masuk')->whereYear('tanggal_transaksi', date('Y'))->sum('jumlah') ?? 0,
            'pengeluaran' => Kas::where('jenis', 'Keluar')->whereYear('tanggal_transaksi', date('Y'))->sum('jumlah') ?? 0,
        ];

        return view('pages.pengurus.dashboard.dashboard', compact('jumlahAnggota', 'kasKopma', 'totalSimpanan', 'dataChart'));
    }
}
