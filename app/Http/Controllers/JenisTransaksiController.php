<?php

namespace App\Http\Controllers;

use App\Models\jenis_transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\transaksi;
use App\Models\kategori;
class JenisTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\jenis_transaksi  $jenis_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(jenis_transaksi $jenis_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jenis_transaksi  $jenis_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(jenis_transaksi $jenis_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jenis_transaksi  $jenis_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jenis_transaksi $jenis_transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jenis_transaksi  $jenis_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(jenis_transaksi $jenis_transaksi)
    {
        //
    }
}
