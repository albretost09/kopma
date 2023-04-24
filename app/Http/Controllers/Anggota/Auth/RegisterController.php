<?php

namespace App\Http\Controllers\Anggota\Auth;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.anggota.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'nim' => 'required',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable',
            'nik' => 'nullable|numeric',
            'fakultas' => 'nullable',
            'jurusan' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable',
            'alamat' => 'nullable',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($request->password != $request->password_confirmation) {
            return redirect()->route('anggota.auth.register')->with('error', 'Password tidak sama.');
        }

        $result = Pengguna::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'password' => bcrypt($request->password),
        ]);

        if ($result) {
            Auth::login($result);
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil.');
        } else {
            return redirect()->route('anggota.auth.register')->with('error', 'Registrasi gagal.');
        }
    }
}
