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
                    <tr>
                        <td>1. </td>
                        <td>22 Januari 1998</td>
                        <td>Cuci</td>
                        <td>1Kg</td>
                        <td>Kimi Räikkönen</td>
                        <td>Proses</td>
                        <td>
                            <div class="row">
                                <div class="col-4">
                                    <a href="/layanan/edit">
                                        <div class="btn btn-warning">ubah</div>
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="btn btn-danger">hapus</div>
                                </div>
                            </div>
                        </td>
                    </tr>
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
                    <form action="" method="post">
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
                                <option>Cuci kering</option>
                                <option>Cuci setrika</option>
                                <option>Setrika saja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan">Berat</label>
                            <div class="input-group mb-3">
                                <input type="number" name="berat" class="form-control"
                                    placeholder="Masukkan berat" aria-label="Masukkan harga satuan"
                                    aria-describedby="basic-addon2">
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
                                <option>Belum diambil</option>
                                <option>Proses</option>
                                <option>Sudah dikerjakan</option>
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
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
