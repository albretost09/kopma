<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Pengguna::query()
            ->where('role', 'ANGGOTA')
            ->oldest('nama')
            ->latest()
            ->get();

        return view('pages.admin.anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $anggota = Pengguna::findOrFail($id);

        return view('pages.admin.anggota.edit', compact('anggota'));
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

        $anggota = Pengguna::findOrFail($id);

        $result = $anggota->update($request->all());

        if ($result) {
            return redirect()->route('admin.anggota.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('admin.anggota.index')->with('error', 'Data gagal diubah');
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
        $anggota = Pengguna::findOrFail($id);

        $result = $anggota->delete();

        if ($result) {
            return redirect()->route('admin.anggota.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('admin.anggota.index')->with('error', 'Data gagal dihapus');
        }
    }
}
