<?php

namespace App\Http\Controllers\Pengurus\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.pengurus.laporan.index');
    }
}
