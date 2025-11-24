@extends('layouts.lte.main')
@section('content')
<div class="container">
    <h1>Edit Data Dokter</h1>
    <form action="{{ route('dokter.update', $dokter->id_dokter) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="bidang_dokter" class="form-label">Bidang Dokter</label>
            <input type="text" class="form-control" id="bidang_dokter" name="bidang_dokter" value="{{ old('bidang_dokter', $dokter->bidang_dokter) }}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $dokter->alamat) }}">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}">
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ old('jenis_kelamin', $dokter->jenis_kelamin) }}" readonly>
        </div>
        <div class="mb-3">
            <label for="id_user" class="form-label">ID User</label>
            <input type="number" class="form-control" id="id_user" name="id_user" value="{{ old('id_user', $dokter->id_user) }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
