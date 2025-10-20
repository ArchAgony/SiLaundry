@extends('master')
@section('isi')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
    </div>
    <div class="card">
        <div class="card-header">
            Laporan yang tersedia
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal transaksi</th>
                        <th>Nama pelanggan</th>
                        <th>Nama layanan</th>
                        <th>Berat</th>
                        <th>Keterangan</th>
                        <th>Total harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->tanggal_transaksi }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>{{ $item->layanan->nama_layanan ?? 'belum ada layanan' }}</td>
                        <td>{{ $item->berat }} Kg</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
