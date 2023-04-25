<?php

namespace App\Http\Controllers\Pengawas\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UbahProfilController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'nik' => 'nullable|numeric|digits:16',
        ]);

        $user = auth()->user();
        $result = $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'nik' => $request->nik,
        ]);

        if ($result) {
            return redirect()->route('pengawas.profil.index')->with('success', 'Profil berhasil diubah.');
        } else {
            return redirect()->route('pengawas.profil.index')->with('error', 'Profil gagal diubah.');
        }
    }
}
