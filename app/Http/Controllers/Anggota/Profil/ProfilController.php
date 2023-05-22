<?php

namespace App\Http\Controllers\Anggota\Profil;

use App\Http\Controllers\Controller;
use App\Models\PengunduranDiri;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $pengunduranDiri = PengunduranDiri::where('pengguna_id', auth()->user()->id)->first();

        return view('pages.anggota.profil.index', compact('pengunduranDiri'));
    }
}
