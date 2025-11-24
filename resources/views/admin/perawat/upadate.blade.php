@extends('layouts.lte.main')
@section('content')
<div class="container">
    <h1>Edit Data Perawat</h1>
    <form action="{{ route('perawat.update', $perawat->id_perawat) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $perawat->alamat) }}">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $perawat->no_hp) }}">
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ old('jenis_kelamin', $perawat->jenis_kelamin) }}" readonly>
        </div>
        <div class="mb-3">
            <label for="pendidikan" class="form-label">Pendidikan</label>
            <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan', $perawat->pendidikan) }}">
        </div>
        <div class="mb-3">
            <label for="id_user" class="form-label">ID User</label>
            <input type="number" class="form-control" id="id_user" name="id_user" value="{{ old('id_user', $perawat->id_user) }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('perawat.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
