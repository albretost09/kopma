<?php

namespace App\Http\Controllers\Pengurus\Laporan;

use App\Models\Kas;
use App\Models\SHU;
use App\Models\Pengguna;
use App\Models\Simpanan;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanSimpananController extends Controller
{
    public function cetak()
    {
        return view('pages.pengurus.laporan.simpanan.cetak');
    }

    public function cetakPDF(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        $tahun = $request->tahun;

        $anggota = Pengguna::query()
            ->where('status', 'AKTIF')
            ->get();

        $data = [];
        foreach ($anggota as $item) {
            $simpananPokok = $item->simpanan()
                ->where('jenis_simpanan', 'Pokok')
                ->sum('jumlah');
            $simpananSukaRela = $item->simpanan()
                ->where('jenis_simpanan', 'Sukarela')
                ->sum('jumlah');
            $simpananWajib = $item->simpanan()
                ->where('jenis_simpanan', 'Wajib')
                ->sum('jumlah');
            $data[] = [
                'id' => $item->id,
                'nama' => $item->nama,
                'simpanan_pokok' => $simpananPokok,
                'simpanan_wajib' => [
                    'januari' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '01')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'februari' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '02')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'maret' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '03')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'april' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '04')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'mei' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '05')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'juni' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '06')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'juli' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '07')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'agustus' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '08')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'september' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '09')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'oktober' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '10')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'november' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '11')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                    'desember' => $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->whereMonth('tanggal_transaksi', '12')
                        ->whereYear('tanggal_transaksi', $tahun)
                        ->sum('jumlah'),
                ],
                'simpanan_sukarela' => $simpananSukaRela,
                'jumlah_jasa_modal' => $simpananPokok + $simpananWajib,
            ];
        }

        $data = collect($data)->sortBy('nama')->values()->all();

        $logoUPR = base64_encode(file_get_contents(public_path(('backend/assets/media/image/logo-upr.png'))));
        $logoKOPMA = base64_encode(file_get_contents(public_path(('backend/assets/media/image/logo-kopma.png'))));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pages.pengurus.laporan.simpanan.cetak-pdf', compact('tahun', 'data', 'logoUPR', 'logoKOPMA'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("laporan-simpanan-$tahun.pdf");
    }
}
