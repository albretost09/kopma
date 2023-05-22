<?php

namespace App\Http\Controllers\Anggota\Profil;

use App\Http\Controllers\Controller;
use App\Models\PengunduranDiri;
use Illuminate\Http\Request;

class PengunduranDiriController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate(['alasan' => 'required']);

        $result = PengunduranDiri::create([
            'pengguna_id' => auth()->user()->id,
            'alasan' => $request->alasan,
            'tanggal_pengajuan' => date('Y-m-d'),
        ]);

        if ($result) {
            return redirect()->route('anggota.profil.index')->with('success', 'Pengajuan pengunduran diri berhasil.');
        } else {
            return redirect()->route('anggota.profil.index')->with('error', 'Pengajuan pengunduran diri gagal.');
        }
    }
}
