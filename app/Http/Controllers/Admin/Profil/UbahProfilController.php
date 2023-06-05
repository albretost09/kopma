<?php

namespace App\Http\Controllers\Admin\Profil;

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
                'nik' => 'nullable|numeric|digits:16',
            ],
            [
                'nama.required' => 'Nama harus diisi.',
                'username.required' => 'Username harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.',
                'nik.numeric' => 'NIK harus berupa angka.',
                'nik.digits' => 'NIK harus 16 digit.',
            ]
        );

        $user = auth()->user();
        $result = $user->update($request->only('nama', 'username', 'email', 'nik'));

        if ($result) {
            return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil diubah.');
        } else {
            return redirect()->route('admin.profil.index')->with('error', 'Profil gagal diubah.');
        }
    }
}
