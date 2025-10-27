<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Imports\TransaksiImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function exportTransaksi()
    {
        $namaFile = 'transaksi_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new TransaksiExport, $namaFile);
    }

    public function importTransaksi(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new TransaksiImport, $request->file('file'));

        return back()->with('success', 'Data transaksi berhasil diimpor!');
    }

    public function index()
    {
        //
        $layanan = Layanan::all();
        $transaksi = Transaksi::with('layanan')->get();
        return view('transaksi.index', compact('transaksi', 'layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $layananArray = $request->layanan;
        $beratArray = $request->berat;

        foreach ($layananArray as $index => $layananId) {
            Transaksi::create([
                'tanggal_transaksi' => $request->tanggal,
                'id_layanan' => $layananId,
                'berat' => $beratArray[$index],
                'nama_pelanggan' => $request->nama,
                'keterangan' => 'proses',
            ]);
        }

        return redirect('/transaksi')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $transaksi = Transaksi::find($id);

        $transaksi->tanggal_transaksi = $request->tanggal;
        $transaksi->id_layanan = $request->layanan;
        $transaksi->berat = $request->berat;
        $transaksi->nama_pelanggan = $request->nama;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->save();

        return redirect('/transaksi')->with('success', 'Data berhasil diperbarui!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Transaksi::where('id', $id)->delete();
        return redirect('/transaksi')->with('success', 'Data berhasil dihapus!');
    }

    public function struk(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $createdAt = $transaksi->created_at;

        $transaksiList = Transaksi::where('nama_pelanggan', $transaksi->nama_pelanggan)
            ->whereDate('tanggal_transaksi', $transaksi->tanggal_transaksi)
            ->whereBetween('created_at', [
                $createdAt->copy()->subMinutes(2),
                $createdAt->copy()->addMinutes(2)
            ])
            ->with('layanan')
            ->orderBy('id')
            ->get();

        return view('transaksi.struk', compact('transaksiList'));
    }
}
