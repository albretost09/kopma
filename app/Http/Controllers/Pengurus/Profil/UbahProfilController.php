<?php

namespace App\Http\Controllers\Pengurus\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UbahProfilController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'fakultas' => 'nullable',
            'jurusan' => 'nullable',
            'nim' => 'required',
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
            return redirect()->route('pengurus.profil.index')->with('success', 'Profil berhasil diubah.');
        } else {
            return redirect()->route('pengurus.profil.index')->with('error', 'Profil gagal diubah.');
        }
    }
}
