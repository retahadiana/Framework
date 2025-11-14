@extends('Layouts.lte.main')
@section('page-title','Edit Jenis Hewan')
@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Edit Jenis Hewan</h3>
        </div>
        <form action="{{ route('jenis_hewan.update', $jenisHewan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                    <input type="text" name="nama_jenis_hewan" id="nama_jenis_hewan" class="form-control" value="{{ $jenisHewan->nama_jenis_hewan }}" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('jenis_hewan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
