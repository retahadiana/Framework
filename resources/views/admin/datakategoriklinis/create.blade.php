@extends('Layouts.lte.main')
@section('content')
<div class="page-section" style="background: #f6f9fb; min-height: 100vh;">
    <div class="card" style="background: #fff; border-radius: 24px; box-shadow: 0 2px 16px rgba(0,0,0,0.07); padding: 40px 32px; max-width: 480px; margin: 60px auto;">
        <h2 style="text-align: center; color: #22346a; font-weight: 700; margin-bottom: 32px; font-size: 2rem;">Tambah Kategori Klinis</h2>
        <form action="{{ route('kategori-klinis.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_kategori_klinis" class="form-label" style="font-weight: 600; font-size: 1.1rem;">Nama Kategori Klinis</label>
                <input type="text" name="nama_kategori_klinis" class="form-control @error('nama_kategori_klinis') is-invalid @enderror" value="{{ old('nama_kategori_klinis') }}" style="border-radius: 12px; border: 1.5px solid #319da7; font-size: 1.15rem; padding: 12px 16px; margin-top: 8px;">
                @error('nama_kategori_klinis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div style="display: flex; justify-content: center; gap: 24px; margin-top: 32px;">
                <button type="submit" class="btn" style="background: #2ecc71; color: #fff; font-weight: 700; font-size: 1.2rem; border-radius: 12px; padding: 12px 0; width: 180px;">Simpan</button>
                <a href="{{ route('kategori-klinis.index') }}" class="btn" style="background: #7b8a8b; color: #fff; font-weight: 700; font-size: 1.2rem; border-radius: 12px; padding: 12px 0; width: 180px; text-align: center;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
