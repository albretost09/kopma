<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Kas;
use App\Models\User;
use App\Models\Pengguna;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAnggota = Pengguna::where('role', 'ANGGOTA')->count() ?? 0;
        $kasKopma = (Kas::where('jenis', 'Masuk')->sum('jumlah') - Kas::where('jenis', 'Keluar')->where('keterangan', 'NOT LIKE', "%SHU Anggota Koperasi Tahun%")->sum('jumlah')) ?? 0;
        $totalSimpanan = Simpanan::where('jenis_simpanan', '!=', 'SHU')->sum('jumlah') ?? 0;
        $kasTahunIni = (Kas::where('jenis', 'Masuk')->whereYear('tanggal_transaksi', date('Y'))->sum('jumlah') - Kas::where('jenis', 'Keluar')->whereYear('tanggal_transaksi', date('Y'))->sum('jumlah')) ?? 0;
        $pemasukanTahunIni = Kas::where('jenis', 'Masuk')->whereYear('tanggal_transaksi', date('Y'))->sum('jumlah') ?? 0;
        $pengeluaranTahunIni = Kas::where('jenis', 'Keluar')->whereYear('tanggal_transaksi', date('Y'))->sum('jumlah') ?? 0;

        $dataChart = [
            'pemasukan' => Kas::where('jenis', 'Masuk')->orderBy('tanggal_transaksi', 'DESC')->take(9)->pluck('jumlah')->toArray(),
            'pengeluaran' => Kas::where('jenis', 'Keluar')->orderBy('tanggal_transaksi', 'DESC')->take(9)->pluck('jumlah')->toArray(),
        ];

        return view('pages.admin.dashboard.dashboard', compact('jumlahAnggota', 'kasKopma', 'totalSimpanan', 'kasTahunIni', 'pemasukanTahunIni', 'pengeluaranTahunIni', 'dataChart'));
    }
}
