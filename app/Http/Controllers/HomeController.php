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
        if(Auth::user()->role == 'Anak'){
            $transaksi = transaksi::where('is_approved', 0)->orderBy('updated_at', 'desc')->get();
            return view('admin.dashboard', compact('transaksi'));
        }
        else{
            return view('base.dashboard');
        }
    }
}
