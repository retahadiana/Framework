@extends('Layouts.lte.main')
@section('content')
<div class="page-section" style="background: #f6f9fb; min-height: 100vh;">
	<div class="card" style="background: #fff; border-radius: 24px; box-shadow: 0 2px 16px rgba(0,0,0,0.07); padding: 40px 32px; max-width: 480px; margin: 60px auto;">
		<h2 style="text-align: center; color: #22346a; font-weight: 700; margin-bottom: 32px; font-size: 2rem;">Hapus Kategori Klinis</h2>
		<form action="{{ route('kategori-klinis.destroy', $kategoriKlinis->idkategori_klinis) }}" method="POST">
			@csrf
			@method('DELETE')
			<div class="mb-4">
				<p style="font-size: 1.1rem; color: #333; text-align: center;">Apakah Anda yakin ingin menghapus kategori klinis <b>{{ $kategoriKlinis->nama_kategori_klinis }}</b>?</p>
			</div>
			<div style="display: flex; justify-content: center; gap: 24px; margin-top: 32px;">
				<button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight: 700; font-size: 1.2rem; border-radius: 12px; padding: 12px 0; width: 180px;">Hapus</button>
				<a href="{{ route('kategori-klinis.index') }}" class="btn" style="background: #7b8a8b; color: #fff; font-weight: 700; font-size: 1.2rem; border-radius: 12px; padding: 12px 0; width: 180px; text-align: center;">Batal</a>
			</div>
		</form>
	</div>
</div>
@endsection
