<?php

namespace App\Http\Controllers\Admin\PengunduranDiri;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\PengunduranDiri;
use App\Models\RiwayatPenarikan;
use App\Http\Controllers\Controller;

class PengunduranDiriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permintaanPengunduran = PengunduranDiri::with('pengguna')
            ->orderBy('tanggal_pengajuan', 'DESC')
            ->get();

        return view('pages.admin.permintaan-pengunduran.index', compact('permintaanPengunduran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengunduranDiri = PengunduranDiri::findOrfail($id);

        $simpanan = Simpanan::where('pengguna_id', $pengunduranDiri->pengguna_id);
        $totalPenarikan = RiwayatPenarikan::whereIn('simpanan_id', $simpanan->pluck('id'))->sum('jumlah_penarikan');
        $totalSimpanan = $simpanan->sum('jumlah');

        $saldo = $totalSimpanan - $totalPenarikan;

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pages.admin.permintaan-pengunduran.surat', compact('pengunduranDiri', 'saldo'));

        return $pdf->stream("surat-pengunduran-diri-$pengunduranDiri->id.pdf");
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
}
