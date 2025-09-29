<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index']);

Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/layanan/{id}', [LayananController::class, 'destroy']);
Route::post('/layanan/create', [LayananController::class, 'store']);
Route::post('/layanan/edit/{id}', [LayananController::class, 'update']);

Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/{id}', [TransaksiController::class, 'destroy']);
Route::post('/transaksi/create', [TransaksiController::class, 'store']);
Route::post('/transaksi/edit/{id}', [TransaksiController::class, 'update']);
