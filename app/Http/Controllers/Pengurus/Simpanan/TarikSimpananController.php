<?php

namespace App\Http\Controllers\Pengurus\Simpanan;

use Exception;
use App\Models\Admin;
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

        $whatsappAdmin = Admin::query()->where('username', 'admin')->first()->no_hp;

        return view('pages.pengurus.tarik-simpanan.index', compact('saldoSimpanan', 'whatsappAdmin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi' => 'required|in:Tunai,Transfer',
            'jumlah_penarikan' => 'required|numeric',
            'bank_tujuan' => 'required_if:jenis_transaksi,Transfer',
            'nomor_rekening' => 'required_if:jenis_transaksi,Transfer',
        ]);

        $jumlah_tarik = $request->jumlah_penarikan;
        $jumlah_tarik = str_replace('.', '', $jumlah_tarik);
        $jenis_transaksi = $request->jenis_transaksi;
        $simpanan = Simpanan::query()
            ->where('pengguna_id', auth()->user()->id)
            ->where('jenis_simpanan', 'Sukarela')
            ->where('status', 'DITERIMA')
            ->orderBy('jumlah', 'asc');

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

        if ($jumlah_tarik > $saldoSimpanan) {
            return redirect()->route('pengurus.tarik-simpanan.index')->with('error', 'Penarikan gagal diajukan');
        }

        $simpanans = $simpanan->get();

        DB::transaction(function () use ($simpanans, $jumlah_tarik, $jenis_transaksi) {
            try {
                foreach ($simpanans as $simpanan) {
                    if ($jumlah_tarik <= 0) {
                        break;
                    }
                    if ($simpanan->jumlah >= $jumlah_tarik) {
                        $riwayat_simpanan = new RiwayatPenarikan();
                        $riwayat_simpanan->simpanan_id = $simpanan->id;
                        $riwayat_simpanan->jenis_transaksi = $jenis_transaksi;
                        $riwayat_simpanan->jumlah_penarikan = $jumlah_tarik;
                        $riwayat_simpanan->bank_tujuan = $jenis_transaksi == 'Transfer' ? request()->bank_tujuan : null;
                        $riwayat_simpanan->nomor_rekening = $jenis_transaksi == 'Transfer' ? request()->nomor_rekening : null;
                        $riwayat_simpanan->save();

                        $simpanan->jumlah -= $jumlah_tarik;
                        // $simpanan->save();
                        $jumlah_tarik = 0;
                    } else {
                        $riwayat_simpanan = new RiwayatPenarikan();
                        $riwayat_simpanan->simpanan_id = $simpanan->id;
                        $riwayat_simpanan->jenis_transaksi = $jenis_transaksi;
                        $riwayat_simpanan->jumlah_penarikan = $simpanan->jumlah;
                        $riwayat_simpanan->bank_tujuan = $jenis_transaksi == 'Transfer' ? request()->bank_tujuan : null;
                        $riwayat_simpanan->nomor_rekening = $jenis_transaksi == 'Transfer' ? request()->nomor_rekening : null;
                        $riwayat_simpanan->save();

                        $jumlah_tarik -= $simpanan->jumlah;
                        $simpanan->jumlah = 0;
                        // $simpanan->save();
                    }
                }
            } catch (Exception $e) {
                return redirect()->route('pengurus.riwayat-simpanan.index')->with('error', 'Penarikan gagal diajukan');
            }
        });

        return redirect()->route('pengurus.riwayat-simpanan.index')->with('success', 'Penarikan berhasil diajukan');
    }
}