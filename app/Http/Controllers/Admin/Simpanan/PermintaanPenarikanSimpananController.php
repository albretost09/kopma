<?php

namespace App\Http\Controllers\Admin\Simpanan;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RiwayatPenarikan;

class PermintaanPenarikanSimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permintaanPenarikan = RiwayatPenarikan::latest()->get();

        return view('pages.admin.permintaan-penarikan.index', compact('permintaanPenarikan'));
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
        $permintaanPenarikan = RiwayatPenarikan::findOrFail($id);

        return view('pages.admin.permintaan-penarikan.show', compact('permintaanPenarikan'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:DITERIMA,DITOLAK',
        ]);

        $permintaanPenarikan = RiwayatPenarikan::findOrFail($id);

        $result = $permintaanPenarikan->update([
            'status' => $request->status
        ]);

        if ($result) {
            return redirect()->route('admin.permintaan-penarikan.index')->with('success', 'Berhasil mengubah status permintaan penarikan');
        } else {
            return redirect()->route('admin.permintaan-penarikan.index')->with('error', 'Gagal mengubah status permintaan penarikan');
        }
    }
}
