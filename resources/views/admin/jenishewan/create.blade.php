@extends('layouts.lte.main')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3 text-center">Tambah Jenis Hewan</h3>

                    <form action="{{ route('jenis-hewan.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="nama_jenis_hewan">Nama Jenis</label>
                            <input type="text" id="nama_jenis_hewan" name="nama_jenis_hewan" class="form-control @error('nama_jenis_hewan') is-invalid @enderror" value="{{ old('nama_jenis_hewan') }}">
                            @error('nama_jenis_hewan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('jenis-hewan.index') }}" class="btn btn-secondary ml-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
