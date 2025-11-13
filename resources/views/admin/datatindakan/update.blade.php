@extends('Layouts.lte.main')
@section('content')
<div class="page-section" style="background: #f6f9fb; min-height: 100vh;">
	<div class="card" style="background: #fff; border-radius: 24px; box-shadow: 0 2px 16px rgba(0,0,0,0.07); padding: 40px 32px; max-width: 600px; margin: 60px auto;">
		<h2 style="text-align: center; color: #22346a; font-weight: 700; margin-bottom: 32px; font-size: 2rem;">Edit Kode Tindakan & Terapi</h2>
		<form action="{{ route('kode-tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="mb-4">
				<label for="kode" class="form-label" style="font-weight: 600; font-size: 1.1rem;">Kode</label>
				<input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode', $kodeTindakanTerapi->kode) }}" style="border-radius: 12px; border: 1.5px solid #319da7; font-size: 1.15rem; padding: 12px 16px; margin-top: 8px;">
				@error('kode')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-4">
				<label for="deskripsi_tindakan_terapi" class="form-label" style="font-weight: 600; font-size: 1.1rem;">Deskripsi</label>
				<input type="text" name="deskripsi_tindakan_terapi" class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" value="{{ old('deskripsi_tindakan_terapi', $kodeTindakanTerapi->deskripsi_tindakan_terapi) }}" style="border-radius: 12px; border: 1.5px solid #319da7; font-size: 1.15rem; padding: 12px 16px; margin-top: 8px;">
				@error('deskripsi_tindakan_terapi')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-4">
				<label for="idkategori" class="form-label" style="font-weight: 600; font-size: 1.1rem;">Kategori</label>
				<select name="idkategori" class="form-control @error('idkategori') is-invalid @enderror" style="border-radius: 12px; border: 1.5px solid #319da7; font-size: 1.15rem; margin-top: 8px;">
					<option value="">- Pilih Kategori -</option>
					@foreach($kategoriList as $kategori)
						<option value="{{ $kategori->idkategori }}" {{ old('idkategori', $kodeTindakanTerapi->idkategori) == $kategori->idkategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
					@endforeach
				</select>
				@error('idkategori')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-4">
				<label for="idkategori_klinis" class="form-label" style="font-weight: 600; font-size: 1.1rem;">Kategori Klinis</label>
				<select name="idkategori_klinis" class="form-control @error('idkategori_klinis') is-invalid @enderror" style="border-radius: 12px; border: 1.5px solid #319da7; font-size: 1.15rem; margin-top: 8px;">
					<option value="">- Pilih Kategori Klinis -</option>
					@foreach($kategoriKlinisList as $kategoriKlinis)
						<option value="{{ $kategoriKlinis->idkategori_klinis }}" {{ old('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis) == $kategoriKlinis->idkategori_klinis ? 'selected' : '' }}>{{ $kategoriKlinis->nama_kategori_klinis }}</option>
					@endforeach
				</select>
				@error('idkategori_klinis')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div style="display: flex; justify-content: center; gap: 24px; margin-top: 32px;">
				<button type="submit" class="btn" style="background: #2ecc71; color: #fff; font-weight: 700; font-size: 1.2rem; border-radius: 12px; padding: 12px 0; width: 180px;">Simpan</button>
				<a href="{{ route('kode-tindakan-terapi.index') }}" class="btn" style="background: #7b8a8b; color: #fff; font-weight: 700; font-size: 1.2rem; border-radius: 12px; padding: 12px 0; width: 180px; text-align: center;">Batal</a>
			</div>
		</form>
	</div>
</div>
@endsection
