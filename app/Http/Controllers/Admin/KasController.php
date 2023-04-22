<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kas = Kas::latest()->get();
        $saldoKas = (Kas::where('jenis', 'Masuk')->sum('jumlah') - Kas::where('jenis', 'Keluar')->sum('jumlah'));
        $jumlahKeluar = Kas::where('jenis', 'Keluar')->sum('jumlah');
        $jumlahMasuk = Kas::where('jenis', 'Masuk')->sum('jumlah');

        return view('pages.admin.kas.index', compact('kas', 'saldoKas', 'jumlahKeluar', 'jumlahMasuk'));
    }

    public function data(Request $request)
    {
        $kas = Kas::query();

        $saldoKas = (Kas::where('jenis', 'Masuk')->sum('jumlah') - Kas::where('jenis', 'Keluar')->sum('jumlah'));
        $jumlahKeluar = Kas::where('jenis', 'Keluar')->sum('jumlah');
        $jumlahMasuk = Kas::where('jenis', 'Masuk')->sum('jumlah');

        if (!empty($request->periode)) {
            $kas->whereMonth('created_at', $request->periode);
        }

        if (!empty($request->jenis_kas)) {
            $kas->where('jenis', $request->jenis_kas);
        }

        $kas = $kas->latest()->get();

        return view('pages.admin.kas.data', compact('kas', 'saldoKas', 'jumlahKeluar', 'jumlahMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.kas.create');
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
            'jenis' => 'required|in:Keluar,Masuk',
            'jumlah' => 'required',
            'keterangan' => 'nullable',
            'no_cek' => 'nullable',
        ]);

        $data = $request->all();
        $data['jumlah'] = str_replace('.', '', $data['jumlah']);

        $result = Kas::create($data);

        if ($result) {
            return redirect()->route('admin.kas.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('admin.kas.index')->with('error', 'Data gagal disimpan');
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
        $kas = Kas::findOrFail($id);

        return view('pages.admin.kas.edit', compact('kas'));
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
            'jenis' => 'required|in:Keluar,Masuk',
            'jumlah' => 'required',
            'keterangan' => 'nullable',
            'no_cek' => 'nullable',
        ]);

        $data = $request->all();
        $data['jumlah'] = str_replace('.', '', $data['jumlah']);
        $data['tanggal_transaksi'] = date('Y-m-d', strtotime($data['tanggal_transaksi']));

        $result = Kas::findOrFail($id)->update($data);

        if ($result) {
            return redirect()->route('admin.kas.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('admin.kas.index')->with('error', 'Data gagal diubah');
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
        $result = Kas::destroy($id);

        if ($result) {
            return redirect()->route('admin.kas.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('admin.kas.index')->with('error', 'Data gagal dihapus');
        }
    }
}
