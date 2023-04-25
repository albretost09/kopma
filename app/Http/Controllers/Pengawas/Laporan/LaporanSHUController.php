<?php

namespace App\Http\Controllers\Pengawas\Laporan;

use App\Models\Kas;
use App\Models\SHU;
use App\Models\Pengguna;
use App\Models\Simpanan;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanSHUController extends Controller
{
    public function cetak()
    {
        return view('pages.pengawas.laporan.shu.cetak');
    }

    public function cetakPDF(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        $tahun = $request->tahun;

        $SHU = SHU::where('tahun', $tahun)->get();

        $anggota = Pengguna::query()
            ->where('status', 'AKTIF')
            ->get();

        $nominalAnggotaKoperasi = SHU::where('kebijakan', 'Anggota Koperasi')->where('tahun', date('Y'))->first()->nominal ?? 0;
        $totalSimpananSemuaAnggota = Simpanan::where('jenis_simpanan', 'Pokok')->orWhere('jenis_simpanan', 'Wajib')->sum('jumlah') ?? 0;

        $dataSHU = [];
        foreach ($anggota as $item) {
            $simpananPokok = $item->simpanan()
                ->where('jenis_simpanan', 'Pokok')
                ->sum('jumlah');
            $simpananWajib = $item->simpanan()
                ->where('jenis_simpanan', 'Wajib')
                ->sum('jumlah');
            $dataSHU[] = [
                'id' => $item->id,
                'nama' => $item->nama,
                'total_simpanan' => $simpananPokok + $simpananWajib,
                'shu' => (($simpananPokok + $simpananWajib) / $totalSimpananSemuaAnggota) * $nominalAnggotaKoperasi,
            ];
        }

        $dataSHU = collect($dataSHU)->sortBy('nama')->values()->all();

        $data = [
            'tahun' => $tahun,
            'jumlahSHU' => (Kas::where('jenis', 'Masuk')->sum('jumlah') - Kas::where('jenis', 'Keluar')->sum('jumlah')),
        ];

        $logoUPR = base64_encode(file_get_contents(public_path(('backend/assets/media/image/logo-upr.png'))));
        $logoKOPMA = base64_encode(file_get_contents(public_path(('backend/assets/media/image/logo-kopma.png'))));

        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('pages.pengawas.laporan.shu.cetak-pdf', compact('SHU', 'data', 'dataSHU', 'logoUPR', 'logoKOPMA'));
        return $pdf->stream("laporan-shu-$tahun.pdf");
    }
}
