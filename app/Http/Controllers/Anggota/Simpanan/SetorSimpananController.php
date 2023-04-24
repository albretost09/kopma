<?php

namespace App\Http\Controllers\Anggota\Simpanan;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;

class SetorSimpananController extends Controller
{
    public function index()
    {
        return view('pages.anggota.setor-simpanan.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi' => 'required|in:Tunai,Transfer',
            'jenis_simpanan' => 'required|in:Pokok,Wajib,Sukarela',
            'jumlah' => 'required|numeric',
            'bukti_transaksi' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['jumlah'] = str_replace('.', '', $data['jumlah']);
        $data['pengguna_id'] = auth()->user()->id;
        $data['bukti_transaksi'] = $request->file('bukti_transaksi') ? $request->file('bukti_transaksi')->store('bukti-transaksi', 'public') : null;

        $simpananPokok = Simpanan::query()
            ->where('pengguna_id', auth()->user()->id)
            ->where('jenis_simpanan', 'Pokok')->exists();

        if ($request->jenis_simpanan == 'Pokok') {
            if ($simpananPokok) {
                return redirect()->route('anggota.setor-simpanan.index')->with('error', 'Anda sudah memiliki simpanan pokok');
            }
        } else {
            if (!$simpananPokok) {
                return redirect()->route('anggota.setor-simpanan.index')->with('error', 'Anda belum memiliki simpanan pokok');
            }
        }

        $result = Simpanan::create($data);

        if ($result) {
            return redirect()->route('anggota.riwayat-simpanan.index')->with('success', 'Simpanan berhasil disetor');
        } else {
            return redirect()->route('anggota.riwayat-simpanan.index')->with('error', 'Simpanan gagal disetor');
        }
    }
}
