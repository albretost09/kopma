<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('pages.admin.profil.index');
    }
}
