<?php

namespace App\Http\Controllers\Admin\SHU;

use Exception;
use App\Models\Kas;
use App\Models\SHU;
use App\Models\Pengguna;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PembagianSHUController extends Controller
{
    public function index()
    {
        $jumlahSHU = (Kas::where('jenis', 'Masuk')->sum('jumlah') - Kas::where('jenis', 'Keluar')->where('keterangan', 'NOT LIKE', "%SHU Anggota Koperasi Tahun%")->sum('jumlah'));

        $anggota = Pengguna::query()
            ->where('status', 'AKTIF')
            ->get();

        $tahun = date('Y');
        $checkTahun = SHU::where('tahun', $tahun)->exists();

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
                // jasa modal/total jasa modal*persentase nominal anggota koperasi
                'shu' => (($simpananPokok + $simpananWajib) / $totalSimpananSemuaAnggota) * $nominalAnggotaKoperasi,
            ];
        }

        $dataSHU = collect($dataSHU)->sortBy('nama')->values()->all();

        $SHUCadanganKoperasi = SHU::where('kebijakan', 'Cadangan Koperasi')->where('tahun', date('Y'))->first();
        $SHUAnggotaKoperasi = SHU::where('kebijakan', 'Anggota Koperasi')->where('tahun', date('Y'))->first();
        $SHUDanaSosial = SHU::where('kebijakan', 'Dana Sosial')->where('tahun', date('Y'))->first();

        return view('pages.admin.shu.pembagian-shu.index', compact('jumlahSHU', 'dataSHU', 'checkTahun', 'SHUCadanganKoperasi', 'SHUAnggotaKoperasi', 'SHUDanaSosial'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kebijakan' => 'required',
            'persentase' => 'required',
            'nominal' => 'required',
        ]);

        $tahun = date('Y');
        $checkTahun = SHU::where('tahun', $tahun)->exists();

        if ($checkTahun) {
            return redirect()->route('admin.pembagian-shu.index')->with('error', 'SHU tahun ini sudah dibagikan');
        }

        $penggunaYgDapatSHU = Pengguna::query()
            ->where('status', 'AKTIF')
            ->get();

        try {
            DB::transaction(function () use ($request, $penggunaYgDapatSHU) {
                foreach ($request->kebijakan as $key => $value) {
                    $data = [
                        'kebijakan' => $value,
                        'persentase' => $request->persentase[$key],
                        'nominal' => $request->nominal[$key],
                        'tahun' => date('Y'),
                    ];

                    SHU::create($data);
                }

                $nominalAnggotaKoperasi = SHU::where('kebijakan', 'Anggota Koperasi')->where('tahun', date('Y'))->first()->nominal ?? 0;
                $totalSimpananSemuaAnggota = Simpanan::where('jenis_simpanan', 'Pokok')->orWhere('jenis_simpanan', 'Wajib')->sum('jumlah') ?? 0;

                $jumlahSHUnya = 0;
                foreach ($penggunaYgDapatSHU as $item) {
                    $simpananPokok = $item->simpanan()
                        ->where('jenis_simpanan', 'Pokok')
                        ->sum('jumlah');
                    $simpananWajib = $item->simpanan()
                        ->where('jenis_simpanan', 'Wajib')
                        ->sum('jumlah');

                    $jumlahSHU = (($simpananPokok + $simpananWajib) / $totalSimpananSemuaAnggota) * $nominalAnggotaKoperasi;

                    if ($jumlahSHU > 0) {
                        Simpanan::create([
                            'pengguna_id' => $item->id,
                            'jenis_simpanan' => 'SHU',
                            'jumlah' => (($simpananPokok + $simpananWajib) / $totalSimpananSemuaAnggota) * $nominalAnggotaKoperasi,
                        ]);
                    }

                    $jumlahSHUnya += $jumlahSHU;
                }

                Kas::create([
                    'jenis' => 'Keluar',
                    'jumlah' => $jumlahSHUnya,
                    'keterangan' => 'SHU Anggota Koperasi Tahun ' . date('Y'),
                ]);
            });

            return redirect()->route('admin.pembagian-shu.index')->with('success', 'SHU berhasil dibagikan');
        } catch (Exception $e) {
            return redirect()->route('admin.pembagian-shu.index')->with('error', 'SHU gagal dibagikan');
        }
    }
}
