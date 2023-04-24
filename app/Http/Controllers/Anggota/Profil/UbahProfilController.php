<?php

namespace App\Http\Controllers\Anggota\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UbahProfilController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'nama' => 'nullable',
            'username' => 'nullable',
            'email' => 'nullable|email',
            'fakultas' => 'nullable',
            'jurusan' => 'nullable',
            'nim' => 'nullable',
            'nik' => 'nullable|numeric|digits:16',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
        ]);

        $user = auth()->user();
        $result = $user->update($request->all());

        if ($result) {
            return redirect()->route('anggota.profil.index')->with('success', 'Profil berhasil diubah.');
        } else {
            return redirect()->route('anggota.profil.index')->with('error', 'Profil gagal diubah.');
        }
    }
}
