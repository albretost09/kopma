<?php

namespace App\Http\Controllers\Anggota\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UbahKontakController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(
            [
                'tempat_lahir' => 'nullable',
                'tanggal_lahir' => 'nullable|date_format:d-m-Y',
                'jenis_kelamin' => 'nullable|in:L,P',
                'no_hp' => 'nullable|numeric',
                'alamat' => 'nullable',
            ],
            [
                'tanggal_lahir.date_format' => 'Tanggal lahir tidak valid.',
                'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
                'no_hp.numeric' => 'No. HP harus berupa angka.',
            ]
        );

        $user = auth()->user();
        $result = $user->update($request->all());

        if ($result) {
            return redirect()->route('anggota.profil.index')->with('success', 'Profil berhasil diubah.');
        } else {
            return redirect()->route('anggota.profil.index')->with('error', 'Profil gagal diubah.');
        }
    }
}
