@extends('master')
@section('isi')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah layanan</h1>
        <a href="/layanan" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
                class="fas fa-arrow fa-sm text-white-50"></i>Kembali</a>
    </div>
    <form action="" method="post">
    @csrf
    <div class="form-group">
        <label for="nama_layanan">Nama layanan</label>
        <input type="text" name="nama" class="form-control" id="nama_layanan" placeholder="Masukkan nama layanan">
    </div>
    <div class="form-group">
        <label for="deskripsi_layanan">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" id="deskripsi_layanan" rows="3" placeholder="Masukkan deskripsi layanan"></textarea>
    </div>
    <div class="form-group">
        <label for="harga_satuan">Harga satuan</label>
        <input type="number" name="harga" class="form-control" id="harga_satuan" placeholder="Masukkan harga satuan">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
