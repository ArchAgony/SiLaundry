<?php

namespace App\Imports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\ToModel;

class TransaksiImport implements ToModel
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

        return new Transaksi([
            'tanggal_transaksi' => $row[1],
            'nama_pelanggan'    => $row[2],
            'id_layanan'        => $row[3],
            'berat'             => $row[5],
            'keterangan'        => $row[8],
        ]);
    }
}
