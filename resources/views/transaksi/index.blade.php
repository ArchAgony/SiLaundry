@extends('master')
@section('isi')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
        {{-- <a href="/layanan/create" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-arrow fa-sm text-white-50"></i>Tambah data</a> --}}
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <a href="{{ route('transaksi.export') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
            </div>
            <div class="col">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#Import">
                    <i class="fas fa-upload"></i> Import Excel
                </button>
            </div>
            <div class="col">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
                    data-target="#Tambah">
                    <i class="fas fa-fw fa-plus"></i> Tambah data
                </button>
            </div>
        </div>

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
                                    <div class="col">
                                        <div class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#Ubah{{ $item->id }}"><i class="fas fa-fw fa-edit"></i> ubah
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})"><i
                                                class="fas fa-fw fa-times"></i> hapus</div>
                                        <form id="delete-form-{{ $item->id }}" action="/transaksi/{{ $item->id }}"
                                            method="GET" style="display:none;">
                                        </form>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('transaksi.cetak', $item->id) }}" target="_blank"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-print"></i> cetak
                                        </a>
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
                                                    placeholder="Masukkan nama pelanggan"
                                                    value="{{ $item->nama_pelanggan }}">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahLabel">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="/transaksi/create" method="post" id="formTransaksi">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal Transaksi</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" name="nama" class="form-control"
                                placeholder="Masukkan nama pelanggan" required>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Detail Layanan</h6>
                            <button type="button" class="btn btn-sm btn-primary" id="tambahLayanan">
                                <i class="fas fa-plus"></i> Tambah Layanan
                            </button>
                        </div>

                        <!-- Container untuk layanan -->
                        <div id="containerLayanan">
                            <div class="layanan-item border rounded p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Layanan <span class="text-danger">*</span></label>
                                            <select class="form-control" name="layanan[]" required>
                                                <option value="">Pilih layanan...</option>
                                                @foreach ($layanan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_layanan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Berat (Kg) <span class="text-danger">*</span></label>
                                            <input type="number" name="berat[]" class="form-control" placeholder="0"
                                                step="0.1" min="0.1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <button type="button" class="btn btn-danger btn-sm mt-3 hapus-layanan"
                                            style="display:none;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center mt-4">
                            <div class="col">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
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
                    <form action="{{ route('transaksi.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                        <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-upload"></i> Import Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    let layananCount = 1;

    // Tambah layanan baru
    $('#tambahLayanan').click(function() {
        layananCount++;
        
        const newLayanan = `
            <div class="layanan-item border rounded p-3 mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Layanan <span class="text-danger">*</span></label>
                            <select class="form-control" name="layanan[]" required>
                                <option value="">Pilih layanan...</option>
                                @foreach ($layanan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Berat (Kg) <span class="text-danger">*</span></label>
                            <input type="number" name="berat[]" class="form-control" 
                                   placeholder="0" step="0.1" min="0.1" required>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-danger btn-sm mt-3 hapus-layanan">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        $('#containerLayanan').append(newLayanan);
        updateHapusButton();
    });

    // Hapus layanan
    $(document).on('click', '.hapus-layanan', function() {
        $(this).closest('.layanan-item').remove();
        layananCount--;
        updateHapusButton();
    });

    // Update visibility tombol hapus
    function updateHapusButton() {
        const items = $('.layanan-item').length;
        if (items > 1) {
            $('.hapus-layanan').show();
        } else {
            $('.hapus-layanan').hide();
        }
    }

    // Reset form ketika modal ditutup
    $('#Tambah').on('hidden.bs.modal', function () {
        $('#formTransaksi')[0].reset();
        $('.layanan-item:not(:first)').remove();
        layananCount = 1;
        updateHapusButton();
    });
});
</script>
@endpush