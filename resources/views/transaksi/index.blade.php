@extends('master')
@section('isi')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
        {{-- <a href="/layanan/create" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-arrow fa-sm text-white-50"></i>Tambah data</a> --}}
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
            data-target="#Tambah">
            Tambah data
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            Total layanan yang ada
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal transaksi</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Nama pelanggan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->layanan->nama_layanan ?? 'belum ada layanan' }}</td>
                            <td>{{ $item->berat }} Kg</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="btn btn-warning" data-toggle="modal" data-target="#Ubah">ubah</div>
                                    </div>
                                    <div class="col">
                                        <a href="/transaksi/{{ $item->id }}">
                                            <div class="btn btn-danger">hapus</div>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <div class="modal fade" id="Ubah" tabindex="-1" aria-labelledby="UbahLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="UbahLabel">Ubah layanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="/transaksi/edit/{{ $item->id }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_layanan">Tanggal transaksi</label>
                                            <input type="date" name="tanggal" class="form-control" id="nama_layanan"
                                                placeholder="Masukkan tanggal transaksi"
                                                value="{{ $item->tanggal_transaksi }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi_layanan">Layanan</label>
                                            <select class="form-control" name="layanan" id="exampleFormControlSelect1">
                                                <option value="">Pilih layanan...</option>
                                                @foreach ($layanan as $l)
                                                    <option value="{{ $l->id }}"
                                                        {{ $l->id == $item->id_layanan ? 'selected' : '' }}>
                                                        {{ $l->nama_layanan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_satuan">Berat</label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="berat" class="form-control"
                                                    placeholder="Masukkan berat" aria-label="Masukkan harga satuan"
                                                    aria-describedby="basic-addon2" value="{{ $item->berat }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_layanan">Nama pelanggan</label>
                                            <input type="text" name="nama" class="form-control" id="nama_layanan"
                                                placeholder="Masukkan nama pelanggan" value="{{ $item->nama_pelanggan }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi_layanan">Keterangan</label>
                                            <select name="keterangan" class="form-control">
                                                <option value="">Pilih keterangan...</option>
                                                <option value="belum diambil"
                                                    {{ $item->keterangan == 'belum diambil' ? 'selected' : '' }}>
                                                    Belum diambil
                                                </option>
                                                <option value="proses"
                                                    {{ $item->keterangan == 'proses' ? 'selected' : '' }}>
                                                    Proses
                                                </option>
                                                <option value="sudah dikerjakan"
                                                    {{ $item->keterangan == 'sudah dikerjakan' ? 'selected' : '' }}>
                                                    Sudah dikerjakan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Batal</button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="Tambah" tabindex="-1" aria-labelledby="TambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahLabel">Tambah layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="/transaksi/create" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama_layanan">Tanggal transaksi</label>
                            <input type="date" name="tanggal" class="form-control" id="nama_layanan"
                                placeholder="Masukkan tanggal transaksi">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_layanan">Layanan</label>
                            <select class="form-control" name="layanan" id="exampleFormControlSelect1">
                                <option selected value="">Pilih layanan...</option>
                                @foreach ($layanan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan">Berat</label>
                            <div class="input-group mb-3">
                                <input type="number" name="berat" class="form-control" placeholder="Masukkan berat"
                                    aria-label="Masukkan harga satuan" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_layanan">Nama pelanggan</label>
                            <input type="text" name="nama" class="form-control" id="nama_layanan"
                                placeholder="Masukkan nama pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_layanan">Keterangan</label>
                            <select class="form-control" name="keterangan" id="exampleFormControlSelect1">
                                <option selected value="">Pilih keterangan...</option>
                                <option value="belum diambil">Belum diambil</option>
                                <option value="proses">Proses</option>
                                <option value="sudah dikerjakan">Sudah dikerjakan</option>
                            </select>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
