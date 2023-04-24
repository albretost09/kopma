<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurus = Pengguna::query()
            ->where('role', 'PENGURUS')
            ->oldest('nama')
            ->latest()
            ->get();

        return view('pages.admin.pengurus.index', compact('pengurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pengurus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:pengguna,username',
            'email' => 'required|email|unique:pengguna,email',
            'nim' => 'required|unique:pengguna,nim',
            'fakultas' => 'required|in:FKIP,Ekonomi,Pertanian,Teknik,Hukum,FISIP,Dokter,MIPA',
            'no_hp' => 'nullable',
        ]);

        $result = Pengguna::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'nim' => $request->nim,
            'fakultas' => $request->fakultas,
            'no_hp' => $request->no_hp,
            'role' => 'PENGURUS',
        ]);

        if ($result) {
            return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil ditambahkan');
        } else {
            return redirect()->route('admin.pengurus.index')->with('error', 'Pengurus gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengurus = Pengguna::findOrFail($id);

        return view('pages.admin.pengurus.edit', compact('pengurus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:pengguna,username,' . $id,
            'email' => 'required|email|unique:pengguna,email,' . $id,
            'nim' => 'required|unique:pengguna,nim,' . $id,
            'fakultas' => 'required|in:FKIP,Ekonomi,Pertanian,Teknik,Hukum,FISIP,Dokter,MIPA',
            'no_hp' => 'nullable',
        ]);

        $pengurus = Pengguna::findOrFail($id);

        $result = $pengurus->update($request->all());

        if ($result) {
            return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil diubah');
        } else {
            return redirect()->route('admin.pengurus.index')->with('error', 'Pengurus gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengurus = Pengguna::findOrFail($id);

        $result = $pengurus->delete();

        if ($result) {
            return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil dihapus');
        } else {
            return redirect()->route('admin.pengurus.index')->with('error', 'Pengurus gagal dihapus');
        }
    }
}
