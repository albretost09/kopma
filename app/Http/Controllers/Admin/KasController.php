<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
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

        if (!empty($request->bulan)) {
            $kas->whereMonth('tanggal_transaksi', $request->bulan);
            $saldoKas = (Kas::where('jenis', 'Masuk')->whereMonth('tanggal_transaksi', $request->bulan)->sum('jumlah') - Kas::where('jenis', 'Keluar')->whereMonth('tanggal_transaksi', $request->bulan)->sum('jumlah'));
            $jumlahKeluar = Kas::where('jenis', 'Keluar')->whereMonth('tanggal_transaksi', $request->bulan)->sum('jumlah');
            $jumlahMasuk = Kas::where('jenis', 'Masuk')->whereMonth('tanggal_transaksi', $request->bulan)->sum('jumlah');
        }

        if (!empty($request->tahun)) {
            $kas->whereYear('tanggal_transaksi', $request->tahun);
            $saldoKas = (Kas::where('jenis', 'Masuk')->whereYear('tanggal_transaksi', $request->tahun)->sum('jumlah') - Kas::where('jenis', 'Keluar')->whereYear('tanggal_transaksi', $request->tahun)->sum('jumlah'));
            $jumlahKeluar = Kas::where('jenis', 'Keluar')->whereYear('tanggal_transaksi', $request->tahun)->sum('jumlah');
            $jumlahMasuk = Kas::where('jenis', 'Masuk')->whereYear('tanggal_transaksi', $request->tahun)->sum('jumlah');
        }

        if (!empty($request->jenis_kas)) {
            $kas->where('jenis', $request->jenis_kas);
            $saldoKas = (Kas::where('jenis', 'Masuk')->where('jenis', $request->jenis_kas)->sum('jumlah') - Kas::where('jenis', 'Keluar')->where('jenis', $request->jenis_kas)->sum('jumlah'));
            $jumlahKeluar = Kas::where('jenis', 'Keluar')->where('jenis', $request->jenis_kas)->sum('jumlah');
            $jumlahMasuk = Kas::where('jenis', 'Masuk')->where('jenis', $request->jenis_kas)->sum('jumlah');
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
        function toRoman($number)
        {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }

        $request->validate([
            'jenis' => 'required|in:Keluar,Masuk',
            'tanggal_transaksi' => 'required|date_format:d/m/Y',
            'jumlah' => 'required',
            'keterangan' => 'nullable',
            'no_cek' => 'nullable',
        ]);

        $data = $request->all();
        $data['jumlah'] = str_replace('.', '', $data['jumlah']);
        $data['dibuat_oleh'] = auth('admin')->user()->nama;

        $bulan = explode('/', $data['tanggal_transaksi'])[1];
        $tahun = explode('/', $data['tanggal_transaksi'])[2];
        $nomor = Kas::whereMonth('tanggal_transaksi', $bulan)->whereYear('tanggal_transaksi', $tahun)->where('jenis', $data['jenis'])->exists() ? Kas::whereMonth('tanggal_transaksi', $bulan)->whereYear('tanggal_transaksi', $tahun)->where('jenis', $data['jenis'])->latest()->first()->id + 1 : 1;
        $nomor = str_pad($nomor, 3, '0', STR_PAD_LEFT);
        // convert to romawi
        $bulan = toRoman($bulan);
        $tahun = explode('/', $data['tanggal_transaksi'])[2];
        $jenis = $data['jenis'] == 'Masuk' ? 'UM' : 'UK';
        $no_cek = $nomor . '/' . $jenis . '/' . $bulan . '/' . $tahun;

        if (Kas::where('no_cek', $no_cek)->exists()) {
            $nomor = $nomor + 1;
            // convert to romawi
            $bulan = toRoman($bulan);
            $tahun = explode('/', $data['tanggal_transaksi'])[2];
            $jenis = $data['jenis'] == 'Masuk' ? 'UM' : 'UK';
            $no_cek = $nomor . '/' . $jenis . '/' . $bulan . '/' . $tahun;
        }

        $data['no_cek'] = $no_cek;
        $data['tanggal_transaksi'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_transaksi'])->format('Y-m-d');

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
