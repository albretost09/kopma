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

        $jumlahPengurus = $pengurus->count();

        return view('pages.admin.pengurus.index', compact('pengurus', 'jumlahPengurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = Pengguna::query()
            ->where('role', 'ANGGOTA')
            ->where('status', 'AKTIF')
            ->oldest('nama')
            ->latest()
            ->get();

        return view('pages.admin.pengurus.create', compact('anggota'));
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
            'pengurus' => 'required|array',
        ]);

        $jumlahPengurus = Pengguna::query()
            ->where('role', 'PENGURUS')
            ->count();

        if ($jumlahPengurus + count($request->pengurus) > 3) {
            return redirect()
                ->route('admin.pengurus.index')
                ->with('error', 'Jumlah pengurus tidak boleh lebih dari 3');
        }

        $result = Pengguna::query()
            ->whereIn('id', $request->pengurus)
            ->update([
                'role' => 'PENGURUS',
            ]);

        if ($result) {
            return redirect()
                ->route('admin.pengurus.index')
                ->with('success', 'Berhasil menambahkan pengurus');
        } else {
            return redirect()
                ->route('admin.pengurus.index')
                ->with('error', 'Gagal menambahkan pengurus');
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
        $pengurus = Pengguna::findOrFail($id);

        return view('pages.admin.pengurus.show', compact('pengurus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function status($id)
    {
        $pengurus = Pengguna::findOrFail($id);

        return view('pages.admin.pengurus.status', compact('pengurus'));
    }

    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:AKTIF,NONAKTIF',
        ]);

        $pengurus = Pengguna::findOrFail($id);

        $result = $pengurus->update([
            'status' => $request->status,
        ]);

        if ($result) {
            return redirect()->route('admin.pengurus.index')->with('success', 'Status berhasil diubah');
        } else {
            return redirect()->route('admin.pengurus.index')->with('error', 'Status gagal diubah');
        }
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

        $result = $pengurus->update([
            'role' => 'ANGGOTA',
        ]);

        if ($result) {
            return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil dihapus');
        } else {
            return redirect()->route('admin.pengurus.index')->with('error', 'Pengurus gagal dihapus');
        }
    }
}
