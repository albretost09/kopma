<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengawasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengawas = Admin::query()
            ->where('is_admin', 0)
            ->oldest('nama')
            ->latest()
            ->get();

        return view('pages.admin.pengawas.index', compact('pengawas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pengawas.create');
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
            'nik' => 'required|unique:admin,nik',
            'email' => 'required|unique:admin,email',
            'username' => 'required|unique:admin,username',
            'password' => 'required|confirmed',
        ]);

        if ($request->password != $request->password_confirmation) {
            return redirect()->route('admin.pengawas.index')->with('error', 'Konfirmasi password tidak sesuai');
        }

        $result = Admin::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        if ($result) {
            return redirect()->route('admin.pengawas.index')->with('success', 'Pengawas berhasil ditambahkan');
        } else {
            return redirect()->route('admin.pengawas.index')->with('error', 'Pengawas gagal ditambahkan');
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
        $pengawas = Admin::findOrFail($id);

        return view('pages.admin.pengawas.edit', compact('pengawas'));
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
        $pengawas = Admin::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:admin,nik,' . $pengawas->id,
            'email' => 'required|unique:admin,email,' . $pengawas->id,
            'username' => 'required|unique:admin,username,' . $pengawas->id,
            'password' => 'nullable|confirmed',
        ]);

        if (empty($request->password) && empty($request->password_confirmation)) {
            $result = $pengawas->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'username' => $request->username,
            ]);
        } else {
            if ($request->password != $request->password_confirmation) {
                return redirect()->route('admin.pengawas.index')->with('error', 'Konfirmasi password tidak sesuai');
            }

            $result = $pengawas->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);
        }

        if ($result) {
            return redirect()->route('admin.pengawas.index')->with('success', 'Pengawas berhasil diubah');
        } else {
            return redirect()->route('admin.pengawas.index')->with('error', 'Pengawas gagal diubah');
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
        $pengawas = Admin::findOrFail($id);

        $result = $pengawas->delete();

        if ($result) {
            return redirect()->route('admin.pengawas.index')->with('success', 'Pengawas berhasil dihapus');
        } else {
            return redirect()->route('admin.pengawas.index')->with('error', 'Pengawas gagal dihapus');
        }
    }
}
