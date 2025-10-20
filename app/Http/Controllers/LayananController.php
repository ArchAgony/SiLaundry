<?php

namespace App\Http\Controllers;
use App\Exports\LayananExport;
use App\Imports\LayananImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function exportLayanan()
    {
        $namaFile = 'layanans_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new LayananExport, $namaFile);
    }

    public function importLayanan(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new LayananImport, $request->file('file'));

        return back()->with('success', 'Data layanan berhasil diimpor!');
    }

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
        return redirect('/layanan')->with('success', 'Data berhasil ditambahkan!');
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

        return redirect('/layanan')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Layanan::where('id', $id)->delete();
        return redirect('/layanan')->with('success', 'Data berhasil dihapus!');
    }
}
