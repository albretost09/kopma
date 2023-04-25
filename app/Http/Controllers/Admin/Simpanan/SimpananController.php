<?php

namespace App\Http\Controllers\Admin\Simpanan;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $simpanan = Simpanan::query()
            ->where('jenis_simpanan', '!=', 'SHU')
            ->latest()
            ->get();

        return view('pages.admin.simpanan.index', compact('simpanan'));
    }

    public function data(Request $request)
    {
        $simpanan = Simpanan::query();

        if (!empty($request->jenis_simpanan)) {
            $simpanan->where('jenis_simpanan', $request->jenis_simpanan);
        }

        $simpanan = $simpanan->latest()->get();

        return view('pages.admin.simpanan.data', compact('simpanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
