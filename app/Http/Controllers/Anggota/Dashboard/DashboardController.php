<?php

namespace App\Http\Controllers\Anggota\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.anggota.dashboard.dashboard');
    }
}
