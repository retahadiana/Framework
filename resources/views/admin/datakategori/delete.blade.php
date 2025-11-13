@extends('Layouts.lte.main')
@section('content')
<div class="page-section">
	<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
		<h2 style="color: #319da7;"><i class="fas fa-tags"></i> Hapus Kategori</h2>
	</div>
	<div class="table-responsive" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 32px; max-width: 600px; margin: auto;">
		<form action="{{ route('kategori.destroy', $kategori->idkategori) }}" method="POST">
			@csrf
			@method('DELETE')
			<div class="mb-3">
				<p style="font-size: 1.1rem; color: #333;">Apakah Anda yakin ingin menghapus kategori <b>{{ $kategori->nama_kategori }}</b>?</p>
			</div>
			<div style="display: flex; justify-content: flex-end; gap: 10px;">
				<a href="{{ route('kategori.index') }}" class="btn btn-secondary" style="border-radius: 8px; background: #319da7; color: #fff; font-weight: 600;">Batal</a>
				<button type="submit" class="btn btn-danger" style="border-radius: 8px; font-weight: 600; background: #e74c3c;">Hapus</button>
			</div>
		</form>
	</div>
</div>
@endsection
