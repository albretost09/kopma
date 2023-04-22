<?php

namespace App\Http\Controllers\Anggota\Simpanan;

use Exception;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\RiwayatPenarikan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TarikSimpananController extends Controller
{
    public function index()
    {
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

        $saldoSimpanan = $jumlahSimpanan - $jumlahRiwayatPenarikan;

        return view('pages.anggota.tarik-simpanan.index', compact('saldoSimpanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi' => 'required|in:Tunai,Transfer',
            'jumlah_penarikan' => 'required|numeric',
        ]);

        $jumlah_tarik = $request->jumlah_penarikan;
        $simpanans = Simpanan::query()
            ->where('pengguna_id', auth()->user()->id)
            ->where('jenis_simpanan', 'Sukarela')
            ->where('status', 'DITERIMA')
            ->orderBy('jumlah', 'asc')
            ->get();

        DB::transaction(function () use ($simpanans, $jumlah_tarik) {
            try {
                foreach ($simpanans as $simpanan) {
                    if ($jumlah_tarik <= 0) {
                        break;
                    }
                    if ($simpanan->jumlah >= $jumlah_tarik) {
                        $riwayat_simpanan = new RiwayatPenarikan();
                        $riwayat_simpanan->simpanan_id = $simpanan->id;
                        $riwayat_simpanan->jenis_transaksi = 'Tunai';
                        $riwayat_simpanan->jumlah_penarikan = $jumlah_tarik;
                        $riwayat_simpanan->save();

                        $simpanan->jumlah -= $jumlah_tarik;
                        // $simpanan->save();
                        $jumlah_tarik = 0;
                    } else {
                        $riwayat_simpanan = new RiwayatPenarikan();
                        $riwayat_simpanan->simpanan_id = $simpanan->id;
                        $riwayat_simpanan->jenis_transaksi = 'Tunai';
                        $riwayat_simpanan->jumlah_penarikan = $simpanan->jumlah;
                        $riwayat_simpanan->save();

                        $jumlah_tarik -= $simpanan->jumlah;
                        $simpanan->jumlah = 0;
                        // $simpanan->save();
                    }
                }
            } catch (Exception $e) {
                return redirect()->route('anggota.riwayat-simpanan.index')->with('error', 'Penarikan gagal diajukan');
            }
        });

        return redirect()->route('anggota.riwayat-simpanan.index')->with('success', 'Penarikan berhasil diajukan');
    }
}
