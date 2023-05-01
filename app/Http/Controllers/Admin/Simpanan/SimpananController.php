<?php

namespace App\Http\Controllers\Admin\Simpanan;

use App\Models\Pengguna;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $simpanan = Simpanan::query()
            ->where('jenis_simpanan', '!=', 'SHU')
            ->latest()
            ->get();

        return view('pages.admin.simpanan.index', compact('simpanan'));
    }

    public function data(Request $request)
    {
        $simpanan = Simpanan::query();

        if (!empty($request->jenis_simpanan)) {
            $simpanan->where('jenis_simpanan', $request->jenis_simpanan);
        }

        $simpanan = $simpanan->latest()->get();

        return view('pages.admin.simpanan.data', compact('simpanan'));
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
            ->get();

        return view('pages.admin.simpanan.create', compact('anggota'));
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
            'pengguna_id' => 'required|exists:pengguna,id',
            'jenis_transaksi' => 'required|in:Tunai,Transfer',
            'jenis_simpanan' => 'required|in:Pokok,Wajib,Sukarela',
            'jumlah' => 'required|numeric',
            'bukti_transaksi' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['jumlah'] = str_replace('.', '', $data['jumlah']);
        $data['bukti_transaksi'] = $request->file('bukti_transaksi') ? $request->file('bukti_transaksi')->store('bukti-transaksi', 'public') : null;
        $data['status'] = 'DITERIMA';

        $simpananPokok = Simpanan::query()
            ->where('pengguna_id', $request->pengguna_id)
            ->where('jenis_simpanan', 'Pokok')
            ->where('status', '!=', 'DITOLAK')
            ->exists();

        if ($request->jenis_simpanan == 'Pokok') {
            if ($simpananPokok) {
                return redirect()->route('admin.simpanan.index')->with('error', 'Anda sudah memiliki simpanan pokok');
            }
        } else {
            if (!$simpananPokok) {
                return redirect()->route('admin.simpanan.index')->with('error', 'Anda belum memiliki simpanan pokok');
            }
        }

        $result = Simpanan::create($data);

        if ($result) {
            return redirect()->route('admin.simpanan.index')->with('success', 'Simpanan berhasil disetor');
        } else {
            return redirect()->route('admin.simpanan.index')->with('error', 'Simpanan gagal disetor');
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
        $simpanan = Simpanan::findOrFail($id);

        return view('pages.admin.simpanan.show', compact('simpanan'));
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

    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:DITERIMA,DITOLAK',
        ]);

        $simpanan = Simpanan::findOrFail($id);

        $result = $simpanan->update([
            'status' => $request->status,
        ]);

        if ($request->status == 'DITERIMA' && $result) {
            $simpanan->pengguna->update([
                'status' => 'AKTIF',
            ]);
        }

        if ($result) {
            return redirect()->route('admin.simpanan.index')->with('success', 'Validasi simpanan telah dilakukan');
        } else {
            return redirect()->route('admin.simpanan.index')->with('error', 'Validasi simpanan gagal dilakukan');
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
}
