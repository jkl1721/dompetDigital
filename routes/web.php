<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('tambahTransaksi', [App\Http\Controllers\TransaksiController::class, 'store'])->name('tambahTransaksi');
    Route::post('hapusTransaksi', [App\Http\Controllers\TransaksiController::class, 'destroy'])->name('hapusTransaksi');
    Route::post('approveTransaksi', [App\Http\Controllers\TransaksiController::class, 'approve'])->name('approveTransaksi');
});
