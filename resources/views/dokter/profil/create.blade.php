@extends('Layouts.lte.Dokter.main')

@section('title', 'Buat Profil Dokter')

@section('content')
<div class="container page-section" style="max-width:720px;">
    <h2>Buat Profil Dokter</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('dokter.profil.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
            @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
            @error('no_hp') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Bidang Dokter</label>
            <input type="text" name="bidang_dokter" class="form-control" value="{{ old('bidang_dokter') }}">
            @error('bidang_dokter') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">Pilih</option>
                <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div style="display:flex;gap:0.75rem;">
            <button type="submit" class="button-primary">Simpan Profil</button>
            <a href="{{ route('dokter.dashboard') }}" class="button-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
