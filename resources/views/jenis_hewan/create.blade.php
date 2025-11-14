@extends('Layouts.lte.main')
@section('page-title','Tambah Jenis Hewan')
@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Tambah Jenis Hewan</h3>
        </div>
        <form action="{{ route('jenis_hewan.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                    <input type="text" name="nama_jenis_hewan" id="nama_jenis_hewan" class="form-control" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('jenis_hewan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
