<?php

namespace App\Http\Controllers\Pengurus\Simpanan;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;

class RiwayatSimpananController extends Controller
{
    public function index()
    {
        $simpanan = Simpanan::query()
            ->with('riwayatPenarikan')
            ->where('pengguna_id', auth()->user()->id)->get();

        $riwayatPenarikan = $simpanan->map(function ($item) {
            return $item->riwayatPenarikan;
        });
        $riwayatPenarikan = $riwayatPenarikan->filter(function ($item) {
            return $item->count() > 0;
        })->flatten();

        return view('pages.pengurus.riwayat-simpanan.index', compact('simpanan', 'riwayatPenarikan'));
    }
}
