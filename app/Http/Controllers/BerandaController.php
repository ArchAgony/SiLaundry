<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    //
    public function index() {
        $totalLayanan = Layanan::count();
        $totalTransaksi = Transaksi::count();

        $transaksiHariIni = Transaksi::with('layanan')
            ->whereDate('created_at', Carbon::today())
            ->get();

        $pendapatanHariIni = $transaksiHariIni
        ->where('tanggal_transaksi', Carbon::today()->toDateString())
        ->sum(function($t) {
            $hargaSatuan = optional($t->layanan)->harga_satuan ?? 0;
            return (float) $hargaSatuan * (float) ($t->berat ?? 0);
        });

        $belumDiambil = Transaksi::where('keterangan', 'belum diambil')->count();

        $data = Transaksi::select(
                'tanggal_transaksi as tanggal',
                DB::raw('COUNT(*) as total')
            )
            ->whereDate('tanggal_transaksi', '>=', Carbon::today()->subDays(6))
            ->groupBy('tanggal_transaksi')
            ->orderBy('tanggal_transaksi', 'ASC')
            ->get();

        $labels = $data->pluck('tanggal');
        $counts = $data->pluck('total');

        return view('beranda', compact(
            'totalLayanan',
            'totalTransaksi',
            'pendapatanHariIni',
            'belumDiambil',
            'transaksiHariIni',
            'labels',
            'counts'
        ));
    }
}
