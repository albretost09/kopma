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
            'bulan' => 'nullable|in:01,02,03,04,05,06,07,08,09,10,11,12',
            'tahun' => 'required',
        ]);

        $tahun = $request->tahun;
        $bulan = '';
        switch ($request->bulan) {
            case '01':
                $bulan = 'Januari';
                break;
            case '02':
                $bulan = 'Februari';
                break;
            case '03':
                $bulan = 'Maret';
                break;
            case '04':
                $bulan = 'April';
                break;
            case '05':
                $bulan = 'Mei';
                break;
            case '06':
                $bulan = 'Juni';
                break;
            case '07':
                $bulan = 'Juli';
                break;
            case '08':
                $bulan = 'Agustus';
                break;
            case '09':
                $bulan = 'September';
                break;
            case '10':
                $bulan = 'Oktober';
                break;
            case '11':
                $bulan = 'November';
                break;
            case '12':
                $bulan = 'Desember';
                break;
        }

        $data = Kas::query();

        if (!empty($request->bulan)) {
            $data = $data->whereMonth('tanggal_transaksi', $request->bulan);
        }

        if (!empty($request->tahun)) {
            $data = $data->whereYear('tanggal_transaksi', $request->tahun);
        }

        $data = $data->orderBy('tanggal_transaksi', 'ASC')
            ->get();

        $logoUPR = base64_encode(file_get_contents(public_path(('backend/assets/media/image/logo-upr.png'))));
        $logoKOPMA = base64_encode(file_get_contents(public_path(('backend/assets/media/image/logo-kopma.png'))));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pages.pengurus.laporan.kas.cetak-pdf', compact('tahun', 'bulan', 'data', 'logoUPR', 'logoKOPMA'));
        return $pdf->stream("laporan-kas-$tahun.pdf");
    }
}
