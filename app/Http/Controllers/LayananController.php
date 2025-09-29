<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $layanan = Layanan::all();
        return view('layanan.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        //
        // return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Layanan::create([
            'nama_layanan' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga_satuan' => $request->harga,
        ]);
        return redirect('/layanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        // Layanan $layanan
        )
    {
        //
        // return view('layanan.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $layanan = Layanan::find($id);

        $layanan->nama_layanan = $request->nama;
        $layanan->deskripsi = $request->deskripsi;
        $layanan->harga_satuan = $request->harga;
        $layanan->save();

        return redirect('/layanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Layanan::where('id', $id)->delete();
        return redirect('/layanan');
    }
}
