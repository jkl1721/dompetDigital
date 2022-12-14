<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\transaksi;
use App\Models\kategori;
use App\Models\jenis_transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transaksi = transaksi::where('is_approved', 0)->orderBy('updated_at', 'desc')->get();
        if(Auth::user()->role == 'Anak'){
            return view('admin.dashboard', compact('transaksi'));
        }
        else{
            $transaksi_final = transaksi::where('is_approved', 1)->orderBy('updated_at', 'desc')->get();
            $transaksi_pemasukan1Tahun = transaksi::where('is_approved', 1)->where('id_jenis', 1)->where('updated_at', '>=', date('Y-m-d', strtotime('-1 year')))->orderBy('updated_at', 'desc')->get();
            $transaksi_pengeluaran1Tahun = transaksi::where('is_approved', 1)->where('id_jenis', 2)->where('updated_at', '>=', date('Y-m-d', strtotime('-1 year')))->orderBy('updated_at', 'desc')->get();
            $kategori = kategori::all();
            $jenis_transaksi = jenis_transaksi::all();
            return view('base.dashboard', compact('transaksi','transaksi_pemasukan1Tahun','transaksi_pengeluaran1Tahun', 'transaksi_final', 'kategori', 'jenis_transaksi', ));
        }
    }
}
