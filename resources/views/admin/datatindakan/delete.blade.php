@extends('Layouts.app')
@section('content')
<div class="page-section" style="background: #f6f9fb; min-height: 100vh;">
	<div class="card" style="background: #fff; border-radius: 24px; box-shadow: 0 2px 16px rgba(0,0,0,0.07); padding: 40px 32px; max-width: 600px; margin: 60px auto;">
		<h2 style="text-align: center; color: #22346a; font-weight: 700; margin-bottom: 32px; font-size: 2rem;">Hapus Kode Tindakan & Terapi</h2>
		<form action="{{ route('kode-tindakan-terapi.destroy', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
			@csrf
			@method('DELETE')
			<div class="mb-4">
				<p style="font-size: 1.1rem; color: #333; text-align: center;">Apakah Anda yakin ingin menghapus kode <b>{{ $kodeTindakanTerapi->kode }}</b> dengan deskripsi <b>{{ $kodeTindakanTerapi->deskripsi_tindakan_terapi }}</b>?</p>
			</div>
			<div style="display: flex; justify-content: center; gap: 24px; margin-top: 32px;">
				<button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight: 700; font-size: 1.2rem; border-radius: 12px; padding: 12px 0; width: 180px;">Hapus</button>
				<a href="{{ route('kode-tindakan-terapi.index') }}" class="btn" style="background: #7b8a8b; color: #fff; font-weight: 700; font-size: 1.2rem; border-radius: 12px; padding: 12px 0; width: 180px; text-align: center;">Batal</a>
			</div>
		</form>
	</div>
</div>
@endsection
