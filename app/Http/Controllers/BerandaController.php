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

        $pendapatanHariIni = $transaksiHariIni->sum(function($t) {
        return (float) (optional($t->layanan)->harga_satuan ?? 0);
        });

        $belumDiambil = Transaksi::where('keterangan', 'belum diambil')->count();

        // chart

        $data = Transaksi::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
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
