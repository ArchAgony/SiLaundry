<?php

namespace App\Imports;

use App\Models\Layanan;
use Maatwebsite\Excel\Concerns\ToModel;

class LayananImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0] === 'ID' || $row[0] === null) {
            return null;
        }

        return new Layanan([
            'nama_layanan' => $row[1],
            'deskripsi'    => $row[2],
            'harga_satuan' => $row[3],
        ]);
    }
}
