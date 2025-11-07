@extends('Layouts.app')
@section('content')
<div class="page-section">
	<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
		<h2 style="color: #319da7;"><i class="fas fa-tags"></i> Edit Kategori</h2>
	</div>
	<div class="table-responsive" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 32px; max-width: 600px; margin: auto;">
		<form action="{{ route('kategori.update', $kategori->idkategori) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="mb-3">
				<label for="nama_kategori" class="form-label" style="font-weight: 600;">Nama Kategori</label>
				<input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" style="border-radius: 8px; border: 1px solid #bdbdbd;">
				@error('nama_kategori')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div style="display: flex; justify-content: flex-end; gap: 10px;">
				<a href="{{ route('kategori.index') }}" class="btn btn-secondary" style="border-radius: 8px; background: #319da7; color: #fff; font-weight: 600;">Kembali</a>
				<button type="submit" class="btn btn-success" style="border-radius: 8px; font-weight: 600; background: #2ecc71;">Update</button>
			</div>
		</form>
	</div>
</div>
@endsection
