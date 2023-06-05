<?php

namespace App\Http\Controllers\Pengurus\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UbahProfilController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'username' => 'required',
                'email' => 'required|email',
                'fakultas' => 'nullable',
                'jurusan' => 'nullable',
                'nim' => 'required',
                'nik' => 'nullable|numeric|digits:16',
            ],
            [
                'nama.required' => 'Nama harus diisi.',
                'username.required' => 'Username harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.',
                'nim.required' => 'NIM harus diisi.',
                'nik.numeric' => 'NIK harus berupa angka.',
                'nik.digits' => 'NIK harus 16 digit.',
            ]
        );

        $user = auth()->user();
        $result = $user->update($request->all());

        if ($result) {
            return redirect()->route('pengurus.profil.index')->with('success', 'Profil berhasil diubah.');
        } else {
            return redirect()->route('pengurus.profil.index')->with('error', 'Profil gagal diubah.');
        }
    }
}
