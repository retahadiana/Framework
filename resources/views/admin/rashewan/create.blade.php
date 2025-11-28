@extends('layouts.lte.main')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3 text-center">Tambah Ras Hewan</h3>

                    <form action="{{ route('ras-hewan.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="idjenis_hewan">Jenis Hewan</label>
                            <select name="idjenis_hewan" id="idjenis_hewan" class="form-control @error('idjenis_hewan') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Hewan --</option>
                                @foreach($jenisHewan as $jenis)
                                    <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>{{ $jenis->nama_jenis_hewan }}</option>
                                @endforeach
                            </select>
                            @error('idjenis_hewan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_ras">Nama Ras</label>
                            <input type="text" id="nama_ras" name="nama_ras" class="form-control @error('nama_ras') is-invalid @enderror" value="{{ old('nama_ras') }}">
                            @error('nama_ras')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('ras-hewan.index') }}" class="btn btn-secondary ml-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
