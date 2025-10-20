<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::with('layanan')->get()->map(function ($t) {
            $hargaSatuan = optional($t->layanan)->harga_satuan ?? 0;

            return [
                'ID'                 => $t->id,
                'Tanggal Transaksi'  => $t->tanggal_transaksi,
                'Nama Pelanggan'     => $t->nama_pelanggan,
                'ID Layanan'         => $t->id_layanan,
                'Nama Layanan'       => optional($t->layanan)->nama_layanan ?? '-',
                'Berat (Kg)'         => $t->berat,
                'Harga Satuan'       => $hargaSatuan,
                'Total Harga'        => $hargaSatuan * $t->berat,
                'Keterangan'         => $t->keterangan,
                'Dibuat'             => $t->created_at,
                'Diperbarui'         => $t->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID', 'Tanggal Transaksi', 'Nama Pelanggan', 'ID Layanan',
            'Nama Layanan', 'Berat (Kg)', 'Harga Satuan',
            'Total Harga', 'Keterangan', 'Dibuat', 'Diperbarui',
        ];
    }
}
