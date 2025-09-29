<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        //
        Transaksi::create([
            'tanggal_transaksi' => $request->tanggal,
            'id_layanan' => $request->layanan,
            'berat' => $request->berat,
            'nama_pelanggan' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

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
        return redirect('/transaksi')->with('success', 'Data berhasil dihapus!');;
    }
}
