<?php

namespace App\Http\Controllers\Admin\Simpanan;

use Exception;
use App\Models\Admin;
use App\Models\Pengguna;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\RiwayatPenarikan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\Admin\TerimaPermintaanPenarikan;
use Illuminate\Support\Facades\Mail;

class PermintaanPenarikanSimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permintaanPenarikan = RiwayatPenarikan::latest()->get();

        return view('pages.admin.permintaan-penarikan.index', compact('permintaanPenarikan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {
        $whatsappAdmin = Admin::query()->where('username', 'admin')->first()->no_hp;

        $anggota = Pengguna::query()
            ->where('role', 'ANGGOTA')
            ->get();

        return view('pages.admin.permintaan-penarikan.create', compact('whatsappAdmin', 'anggota'));
    }

    public function data(Request $request)
    {
        $simpanan = Simpanan::query()
            ->where('pengguna_id', $request->pengguna_id)
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

        $saldoSimpanan = ($jumlahSimpanan - $jumlahRiwayatPenarikan);

        return view('pages.admin.permintaan-penarikan.data', compact('saldoSimpanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengguna_id' => 'required|exists:pengguna,id',
            'jenis_transaksi' => 'required|in:Tunai,Transfer',
            'jumlah_penarikan' => 'required|numeric',
            'bank_tujuan' => 'required_if:jenis_transaksi,Transfer',
            'nomor_rekening' => 'required_if:jenis_transaksi,Transfer',
        ]);

        $jumlah_tarik = $request->jumlah_penarikan;
        $jumlah_tarik = str_replace('.', '', $jumlah_tarik);
        $jenis_transaksi = $request->jenis_transaksi;
        $simpanan = Simpanan::query()
            ->where('pengguna_id', $request->pengguna_id)
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
            return redirect()->route('admin.permintaan-penarikan.index')->with('error', 'Saldo tidak mencukupi');
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
                        $riwayat_simpanan->status = 'DITERIMA';
                        $riwayat_simpanan->save();

                        $simpanan->jumlah -= $jumlah_tarik;
                        // $simpanan->save();
                        $jumlah_tarik = 0;
                    } else {
                        $riwayat_simpanan = new RiwayatPenarikan();
                        $riwayat_simpanan->simpanan_id = $simpanan->id;
                        $riwayat_simpanan->jenis_transaksi = $jenis_transaksi;
                        $riwayat_simpanan->jumlah_penarikan = $simpanan->jumlah;
                        $riwayat_simpanan->status = 'DITERIMA';
                        $riwayat_simpanan->save();

                        $jumlah_tarik -= $simpanan->jumlah;
                        $simpanan->jumlah = 0;
                        // $simpanan->save();
                    }
                }
            } catch (Exception $e) {
                return redirect()->route('admin.permintaan-penarikan.index')->with('error', 'Penarikan gagal diajukan');
            }
        });

        return redirect()->route('admin.permintaan-penarikan.index')->with('success', 'Penarikan berhasil diajukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permintaanPenarikan = RiwayatPenarikan::findOrFail($id);

        return view('pages.admin.permintaan-penarikan.show', compact('permintaanPenarikan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'bukti' => 'required_if:status,DITERIMA|image|max:2048',
            'status' => 'required|in:DITERIMA,DITOLAK',
        ]);

        DB::transaction(function () use ($request, $id, &$result) {
            try {
                $permintaanPenarikan = RiwayatPenarikan::findOrFail($id);
                $user = $permintaanPenarikan->simpanan->pengguna;

                Mail::to($user->email)->send(new TerimaPermintaanPenarikan($permintaanPenarikan));

                $result = $permintaanPenarikan->update([
                    'bukti_transfer' => $request->file('bukti')->store('bukti-transfer', 'public'),
                    'status' => $request->status
                ]);
            } catch (Exception $e) {
                return false;
            }
        });

        if ($result) {
            return redirect()->route('admin.permintaan-penarikan.index')->with('success', 'Berhasil mengubah status permintaan penarikan');
        } else {
            return redirect()->route('admin.permintaan-penarikan.index')->with('error', 'Gagal mengubah status permintaan penarikan');
        }
    }
}
