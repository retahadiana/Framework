@extends('layouts.admin')
@section('content')
<div class="container" style="max-width:480px;margin:40px auto;background:#fff;border-radius:14px;box-shadow:0 2px 8px rgba(0,0,0,0.08);padding:32px 28px 24px 28px;">
	<h2 style="font-size:2rem;font-weight:700;margin-bottom:24px;">Edit Jenis Hewan</h2>
	<form action="{{ route('jenis-hewan.update', $item->idjenis_hewan) }}" method="POST">
		@csrf
		@method('PUT')
		<div class="mb-3">
			<label for="nama_jenis_hewan" class="form-label" style="font-weight:500;margin-bottom:8px;display:block;">Nama Jenis Hewan</label>
			<input type="text" name="nama_jenis_hewan" class="form-control @error('nama_jenis_hewan') is-invalid @enderror" value="{{ old('nama_jenis_hewan', $item->nama_jenis_hewan) }}" style="width:100%;padding:12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:20px;font-size:1rem;background:#f9fafb;">
			@error('nama_jenis_hewan')
				<div class="invalid-feedback">{{ $message }}</div>
			@enderror
		</div>
		<a href="{{ route('jenis-hewan.index') }}" class="btn btn-secondary" style="background:#6c757d;color:#fff;border:none;border-radius:6px;padding:12px 0;font-size:1.1rem;font-weight:600;box-shadow:0 1px 4px rgba(108,117,125,0.08);transition:background 0.2s;">Kembali</a>
		<button type="submit" class="btn btn-primary" style="background:#1677ff;color:#fff;border:none;border-radius:6px;padding:12px 0;font-size:1.1rem;font-weight:600;box-shadow:0 1px 4px rgba(22,119,255,0.08);transition:background 0.2s;margin-top:10px;">Simpan Perubahan</button>
	</form>
</div>
@endsection
