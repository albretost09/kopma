<?php

namespace App\Http\Controllers\Anggota\Profil;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\PengunduranDiri;
use App\Models\RiwayatPenarikan;
use App\Http\Controllers\Controller;

class CetakPengunduranDiriController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $pengunduranDiri = PengunduranDiri::where('pengguna_id', auth()->user()->id)->first();

        $simpanan = Simpanan::where('pengguna_id', $pengunduranDiri->pengguna_id);
        $totalPenarikan = RiwayatPenarikan::whereIn('simpanan_id', $simpanan->pluck('id'))->sum('jumlah_penarikan');
        $totalSimpanan = $simpanan->sum('jumlah');

        $saldo = $totalSimpanan - $totalPenarikan;

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pages.admin.permintaan-pengunduran.surat', compact('pengunduranDiri', 'saldo'));
        return $pdf->stream("surat-pengunduran-diri-" . $pengunduranDiri->pengguna->nama . ".pdf");
    }
}
