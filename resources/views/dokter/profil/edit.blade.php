@extends('Layouts.lte.main')

@section('title', 'Edit Profil Dokter')

@section('content')
<div class="container page-section" style="max-width:720px;">
    <h2>Edit Profil Dokter</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('dokter.profil.update', $dokter->id_dokter) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $dokter->alamat) }}</textarea>
            @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $dokter->no_hp) }}">
            @error('no_hp') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Bidang Dokter</label>
            <input type="text" name="bidang_dokter" class="form-control" value="{{ old('bidang_dokter', $dokter->bidang_dokter) }}">
            @error('bidang_dokter') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">Pilih</option>
                <option value="L" {{ old('jenis_kelamin', $dokter->jenis_kelamin)=='L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $dokter->jenis_kelamin)=='P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div style="display:flex;gap:0.75rem;">
            <button type="submit" class="button-primary">Perbarui Profil</button>
            <a href="{{ route('dokter.profil.show', $dokter->id_dokter) }}" class="button-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
