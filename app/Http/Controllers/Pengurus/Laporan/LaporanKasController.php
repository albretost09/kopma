<?php

namespace App\Http\Controllers\Pengurus\Laporan;

use App\Models\Kas;
use App\Models\SHU;
use App\Models\Pengguna;
use App\Models\Simpanan;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanKasController extends Controller
{
    public function cetak()
    {
        return view('pages.pengurus.laporan.kas.cetak');
    }

    public function cetakPDF(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        $tahun = $request->tahun;

        $data = Kas::query()
            ->whereYear('tanggal_transaksi', $tahun)
            ->orderBy('tanggal_transaksi', 'ASC')
            ->get();

        $logoUPR = base64_encode(file_get_contents(public_path(('backend/assets/media/image/logo-upr.png'))));
        $logoKOPMA = base64_encode(file_get_contents(public_path(('backend/assets/media/image/logo-kopma.png'))));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pages.pengurus.laporan.kas.cetak-pdf', compact('tahun', 'data', 'logoUPR', 'logoKOPMA'));
        return $pdf->stream("laporan-kas-$tahun.pdf");
    }
}
