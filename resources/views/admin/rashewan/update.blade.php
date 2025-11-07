@extends('layouts.admin')
@section('content')
<style>
	.ras-create-card {
		max-width: 420px;
		margin: 60px auto;
		background: #fff;
		border-radius: 20px;
		box-shadow: 0 2px 12px rgba(0,0,0,0.08);
		padding: 40px 32px 32px 32px;
		text-align: center;
	}
	.ras-create-title {
		font-size: 2rem;
		font-weight: 700;
		color: #1a3365;
		margin-bottom: 32px;
	}
	.ras-create-label {
		font-weight: 500;
		font-size: 1.1rem;
		color: #1a3365;
		margin-bottom: 10px;
		text-align: left;
		display: block;
	}
	.ras-create-input, .ras-create-select {
		width: 100%;
		padding: 16px;
		border-radius: 12px;
		border: 1px solid #e0e0e0;
		margin-bottom: 28px;
		font-size: 1.1rem;
		background: #f9fafb;
	}
	.ras-create-btn-row {
		display: flex;
		gap: 18px;
		justify-content: center;
		margin-top: 10px;
	}
	.ras-create-btn-simpan {
		background: #27ae60;
		color: #fff;
		border: none;
		border-radius: 10px;
		padding: 18px 0;
		font-size: 1.2rem;
		font-weight: 700;
		width: 48%;
		box-shadow: 0 1px 4px rgba(39,174,96,0.08);
		transition: background 0.2s;
	}
	.ras-create-btn-simpan:hover {
		background: #219150;
	}
	.ras-create-btn-batal {
		background: #7b8a8b;
		color: #fff;
		border: none;
		border-radius: 10px;
		padding: 18px 0;
		font-size: 1.2rem;
		font-weight: 700;
		width: 48%;
		box-shadow: 0 1px 4px rgba(123,138,139,0.08);
		transition: background 0.2s;
		text-decoration: none;
		display: inline-block;
	}
	.ras-create-btn-batal:hover {
		background: #566363;
	}
</style>
<div style="background: #f6fbfd; min-height: 100vh; padding-top: 40px;">
	<div class="ras-create-card">
		<div class="ras-create-title">Edit Ras Hewan</div>
		<form action="{{ route('ras-hewan.update', $item->idras_hewan) }}" method="POST">
			@csrf
			@method('PUT')
			<label for="idjenis_hewan" class="ras-create-label">Jenis Hewan</label>
			<select name="idjenis_hewan" class="ras-create-select @error('idjenis_hewan') is-invalid @enderror">
				<option value="">-- Pilih Jenis Hewan --</option>
				@foreach($jenisHewan as $jenis)
					<option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan', $item->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>{{ $jenis->nama_jenis_hewan }}</option>
				@endforeach
			</select>
			@error('idjenis_hewan')
				<div class="invalid-feedback" style="color:#e74c3c;text-align:left;margin-bottom:10px;">{{ $message }}</div>
			@enderror
			<label for="nama_ras" class="ras-create-label">Nama Ras</label>
			<input type="text" name="nama_ras" class="ras-create-input @error('nama_ras') is-invalid @enderror" value="{{ old('nama_ras', $item->nama_ras) }}">
			@error('nama_ras')
				<div class="invalid-feedback" style="color:#e74c3c;text-align:left;margin-bottom:10px;">{{ $message }}</div>
			@enderror
			<div class="ras-create-btn-row">
				<button type="submit" class="ras-create-btn-simpan">Simpan Perubahan</button>
				<a href="{{ route('ras-hewan.index') }}" class="ras-create-btn-batal">Batal</a>
			</div>
		</form>
	</div>
</div>
@endsection
