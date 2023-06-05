<?php

namespace App\Http\Controllers\Admin\Profil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UbahPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|confirmed',
                'new_password' => 'required|min:8',
            ],
            [
                'password.required' => 'Password baru harus diisi.',
                'password.confirmed' => 'Password baru tidak sama dengan konfirmasi password.',
                'new_password.required' => 'Password baru harus diisi.',
                'new_password.min' => 'Password baru minimal 8 karakter.',
            ]
        );

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->route('admin.profil.index')->with('error', 'Password saat ini salah.');
        }

        $user = auth()->user();
        $result = $user->update([
            'password' => bcrypt($request->password),
        ]);

        if ($result) {
            return redirect()->route('admin.profil.index')->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->route('admin.profil.index')->with('error', 'Password gagal diubah.');
        }
    }
}
