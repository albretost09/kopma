<?php

namespace App\Http\Controllers\Admin\PengunduranDiri;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\PengunduranDiri;
use App\Models\RiwayatPenarikan;
use App\Http\Controllers\Controller;

class ValidasiPengunduranDiriController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:DITERIMA,DITOLAK',
        ]);

        $pengunduranDiri = PengunduranDiri::findOrfail($id);

        $result = $pengunduranDiri->update([
            'status' => $request->status,
        ]);

        if ($result) {
            return redirect()->route('admin.pengunduran-diri.index')->with('success', 'Pengajuan pengunduran diri berhasil diperbarui.');
        } else {
            return redirect()->route('admin.pengunduran-diri.index')->with('error', 'Pengajuan pengunduran diri gagal diperbarui.');
        }
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

        return view('pages.admin.permintaan-pengunduran.data', compact('pengunduranDiri'));
    }
}
