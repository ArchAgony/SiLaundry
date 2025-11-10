@extends('master')
@section('isi')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Layanan</h1>
        {{-- <a href="/layanan/create" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-arrow fa-sm text-white-50"></i>Tambah data</a> --}}
        <div class="row">
            <div class="col-auto">
                <a href="{{ route('layanan.export') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>
            <div class="col-auto">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#Import">
                    <i class="fas fa-upload"></i> Import Excel
                </button>
            </div>
            <div class="col-auto">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
                    data-target="#Tambah">
                    <i class="fas fa-fw fa-plus"></i> Tambah
                </button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Total layanan yang ada
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama layanan</th>
                        <th>Deskripsi</th>
                        <th>Harga satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($layanan as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}.</td>
                            <td>{{ $item->nama_layanan }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#Ubah{{ $item->id }}"><i class="fas fa-fw fa-edit"></i> ubah
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})"><i
                                                class="fas fa-fw fa-times"></i> hapus</div>
                                        <form id="delete-form-{{ $item->id }}" action="/layanan/{{ $item->id }}"
                                            method="GET" style="display:none;">
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="Ubah{{ $item->id }}" tabindex="-1" aria-labelledby="UbahLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="UbahLabel">Ubah layanan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/layanan/edit/{{ $item->id }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama_layanan">Nama layanan</label>
                                                <input type="text" name="nama" class="form-control" id="nama_layanan"
                                                    required placeholder="Masukkan nama layanan"
                                                    value="{{ $item->nama_layanan }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi_layanan">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" id="deskripsi_layanan" required rows="3"
                                                    placeholder="Masukkan deskripsi layanan">{{ $item->deskripsi }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_satuan">Harga satuan</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" name="harga" class="form-control" required
                                                        placeholder="Masukkan harga satuan"
                                                        value="{{ $item->harga_satuan }}"
                                                        aria-label="Masukkan harga satuan" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">Kg</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                            class="fas fa-fw fa-times"></i> Batal</button>
                                                </div>
                                                <div class="col">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-fw fa-save"></i> Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                    <form action="/layanan/create" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama_layanan">Nama layanan</label>
                            <input type="text" name="nama" class="form-control" id="nama_layanan" required
                                placeholder="Masukkan nama layanan">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_layanan">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi_layanan" rows="3"
                                placeholder="Masukkan deskripsi layanan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan">Harga satuan</label>
                            <div class="input-group mb-3">
                                <input type="number" name="harga" class="form-control"
                                    placeholder="Masukkan harga satuan" aria-label="Masukkan harga satuan"
                                    aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-fw fa-times"></i> Batal</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-save"></i>
                                    Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Import" tabindex="-1" aria-labelledby="TambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahLabel">Impor data excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center">
                    <form action="{{ route('layanan.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Import Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
