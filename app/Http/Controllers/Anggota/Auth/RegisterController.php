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
        $request->validate(
            [
                'nama' => 'required|max:255',
                'nim' => 'required|unique:pengguna',
                'username' => 'required|max:255|unique:pengguna',
                'email' => 'required|email|max:255|unique:pengguna',
                'no_hp' => 'nullable',
                'nik' => 'nullable|numeric',
                'fakultas' => 'nullable',
                'jurusan' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'nullable',
                'alamat' => 'nullable',
                'password' => 'required|confirmed|min:8',
            ],
            [
                'nama.required' => 'Nama harus diisi.',
                'nim.required' => 'NIM harus diisi.',
                'nim.unique' => 'NIM sudah terdaftar.',
                'username.required' => 'Username harus diisi.',
                'username.unique' => 'Username sudah terdaftar.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'no_hp.numeric' => 'No. HP harus berupa angka.',
                'nik.numeric' => 'NIK harus berupa angka.',
                'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal.',
                'password.required' => 'Password harus diisi.',
                'password.confirmed' => 'Password tidak sama.',
                'password.min' => 'Password minimal 8 karakter.',
            ]
        );

        if ($request->password != $request->password_confirmation) {
            return redirect()->route('anggota.auth.register')->with('error', 'Password tidak sama.');
        }

        $awalNoHP = substr($request->no_hp, 0, 2);

        $result = Pengguna::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => str_replace('08', '628', $awalNoHP),
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
