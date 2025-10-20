<?php

namespace App\Exports;

use App\Models\Layanan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LayananExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Layanan::all([
            'id',
            'nama_layanan',
            'deskripsi',
            'harga_satuan',
            'created_at',
            'updated_at',
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Layanan',
            'Deskripsi',
            'Harga Satuan',
            'Dibuat',
            'Diperbarui',
        ];
    }
}
