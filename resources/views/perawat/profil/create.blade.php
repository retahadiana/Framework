@extends('Layouts.lte.Perawat.main')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Buat Profil Perawat</h1>
        <div>
            <a href="{{ route('perawat.profil.index') }}" class="btn btn-sm btn-secondary">Lihat Profil</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('perawat.profil.store') }}">
        @csrf

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') }}">
        </div>

        <div class="form-group">
            <label for="no_hp">No. HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}">
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pendidikan">Pendidikan</label>
            <input type="text" name="pendidikan" id="pendidikan" class="form-control" value="{{ old('pendidikan') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Profil</button>
    </form>
</div>
@endsection
