<?php

namespace App\Http\Controllers\Pengawas\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.pengawas.laporan.index');
    }
}
