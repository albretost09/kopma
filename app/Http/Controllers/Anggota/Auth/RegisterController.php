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
                'no_hp' => 'required',
                'nik' => 'nullable|numeric',
                'fakultas' => 'required',
                'jurusan' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date_format:d/m/Y',
                'jenis_kelamin' => 'required|in:L,P',
                'alamat' => 'required',
                'password' => 'required|confirmed|min:8',
            ],
            [
                'nama.required' => 'Nama harus diisi.',
                'nama.max' => 'Nama maksimal 255 karakter.',
                'nim.required' => 'NIM harus diisi.',
                'nim.unique' => 'NIM sudah terdaftar.',
                'username.required' => 'Username harus diisi.',
                'username.max' => 'Username maksimal 255 karakter.',
                'username.unique' => 'Username sudah terdaftar.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.max' => 'Email maksimal 255 karakter.',
                'email.unique' => 'Email sudah terdaftar.',
                'no_hp.required' => 'No. HP harus diisi.',
                'nik.numeric' => 'NIK harus berupa angka.',
                'fakultas.required' => 'Fakultas harus diisi.',
                'jurusan.required' => 'Jurusan harus diisi.',
                'tempat_lahir.required' => 'Tempat lahir harus diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
                'tanggal_lahir.date_format' => 'Tanggal lahir tidak valid.',
                'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
                'alamat.required' => 'Alamat harus diisi.',
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
