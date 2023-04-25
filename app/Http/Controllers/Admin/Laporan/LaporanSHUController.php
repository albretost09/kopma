<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanSHUController extends Controller
{
    public function cetak()
    {
        return view('pages.admin.laporan.shu.cetak');
    }
}
