<?php

namespace App\Http\Controllers\Pengawas\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.pengawas.dashboard.dashboard');
    }
}
