<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index(){
        $layanan = Layanan::all();
        $transaksi = Transaksi::with('layanan')->orderBy('tanggal_transaksi', 'desc')->get();
        $transaksi->transform(function ($t) {
            $hargaSatuan = optional($t->layanan)->harga_satuan ?? 0;
            $t->total_harga = $hargaSatuan * ($t->berat ?? 0);
            return $t;
        });
        return view('laporan.index', compact('transaksi', 'layanan'));
    }
}
