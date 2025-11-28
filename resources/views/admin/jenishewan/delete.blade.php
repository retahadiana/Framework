@extends('layouts.lte.main')
@section('content')
<div class="container" style="max-width:400px;margin:60px auto;background:#fff;border-radius:14px;box-shadow:0 2px 8px rgba(0,0,0,0.08);padding:32px 28px 24px 28px;">
	<h2 style="font-size:1.6rem;font-weight:700;margin-bottom:24px;">Hapus Jenis Hewan</h2>
	<p>Apakah Anda yakin ingin menghapus jenis hewan <strong>{{ $item->nama_jenis_hewan }}</strong>?</p>
	<form action="{{ route('jenis-hewan.destroy', $item->idjenis_hewan) }}" method="POST">
		@csrf
		@method('DELETE')
		<a href="{{ route('jenis-hewan.index') }}" class="btn btn-secondary" style="background:#6c757d;color:#fff;border:none;border-radius:6px;padding:12px 0;font-size:1.1rem;font-weight:600;box-shadow:0 1px 4px rgba(108,117,125,0.08);transition:background 0.2s;">Batal</a>
		<button type="submit" class="btn btn-danger" style="background:#e74c3c;color:#fff;border:none;border-radius:6px;padding:12px 0;font-size:1.1rem;font-weight:600;box-shadow:0 1px 4px rgba(231,76,60,0.08);transition:background 0.2s;margin-top:10px;">Hapus</button>
	</form>
</div>
@endsection
