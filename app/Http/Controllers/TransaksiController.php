<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\kategori;
use App\Models\jenis_transaksi;
class TransaksiController extends Controller
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
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        try{
            $transaksi = new transaksi();
            $transaksi->id_transaksi = $randomString;
            $transaksi->id_jenis = $request->jenisTransaksi;
            $transaksi->id_kategori = $request->kategori;
            $transaksi->id_user = Auth::user()->id_user;
            $transaksi->tanggal = $request->tanggal ?? date('Y-m-d');
            $transaksi->keterangan = $request->keterangan;
            $transaksi->nominal = $request->nominal;
            $transaksi->created_at = date('Y-m-d H:i:s');
            $transaksi->updated_at = date('Y-m-d H:i:s');
            $transaksi->save();
            $user = User::find(Auth::user()->id_user);
            if($request->jenisTransaksi == 1){
                $user->wallet += $user->saldo;
            }
            else{
                $user->wallet -= $user->saldo;
                if ($user->wallet < 0){
                    $user->wallet =0;
                }
            }
            $user->save();
            return response()->json(['status' => true, 'message' => 'Data Transaksi Berhasil Ditambahkan']);
        }
        catch(\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $transaksi = transaksi::find($request->id);
            $user = User::find($transaksi->id_user);
            if($transaksi->id_jenis == 1){
                $user->wallet -= $transaksi->nominal;
                if ($user->wallet < 0){
                    $user->wallet =0;
                }
            }
            else{
                $user->wallet += $transaksi->nominal;
            }
            $user->save();
            $transaksi->delete();
            return response()->json(['status' => true, 'message' => 'Data Transaksi Berhasil Dihapus!']);
        }
        catch(\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
    public function approve(Request $request)
    {
        try{
            $transaksi = transaksi::find($request->id);
            $transaksi->is_approved = 1;
            $transaksi->save();
            return response()->json(['status' => true, 'message' => 'Data Transaksi Berhasil Diapproved!']);
        }
        catch(\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
