<?php

use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/layanan/create', [LayananController::class, 'create']);
Route::get('/layanan/edit', [LayananController::class, 'edit']);

Route::get('/transaksi', [TransaksiController::class, 'index']);
