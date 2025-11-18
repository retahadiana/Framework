@extends('Layouts.lte.perawat.main')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="container page-section">
	<div class="mb-4">
		<h2 style="color:#38a3b7;font-weight:800;letter-spacing:-1px;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.7rem">
			<i class="fas fa-notes-medical"></i> Tambah Rekam Medis
		</h2>
		<div style="height:3px;width:100px;background:linear-gradient(90deg,#38a3b7,#0891b2,#3b82f6);border-radius:2px;margin-bottom:1.5rem;"></div>
	</div>

	<div class="card shadow-sm border-0" style="border-radius:18px;max-width:600px;margin:0 auto;">
		<div class="card-body">
			@if(session('success'))
				<div class="alert alert-success">{{ session('success') }}</div>
			@elseif($errors->any())
				<div class="alert alert-danger">
					<ul class="mb-0">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form method="POST" action="{{ route('perawat.rekam_medis.store') }}">
				@csrf
				<input type="hidden" name="idreservasi_dokter" value="{{ request('id') }}" />

				<div class="mb-3">
					<label for="anamnesa" class="form-label fw-semibold">Anamnesa</label>
					<textarea name="anamnesa" id="anamnesa" class="form-control" required>{{ old('anamnesa') }}</textarea>
				</div>
				<div class="mb-3">
					<label for="temuan_klinis" class="form-label fw-semibold">Temuan Klinis</label>
					<textarea name="temuan_klinis" id="temuan_klinis" class="form-control" required>{{ old('temuan_klinis') }}</textarea>
				</div>
				<div class="mb-3">
					<label for="diagnosa" class="form-label fw-semibold">Diagnosa</label>
					<textarea name="diagnosa" id="diagnosa" class="form-control" required>{{ old('diagnosa') }}</textarea>
				</div>

				<div class="d-flex gap-2 mt-4">
					<button type="submit" class="btn btn-primary" style="border-radius:8px;font-weight:600;">Simpan Rekam Medis</button>
					<a href="{{ route('perawat.rekam_medis.index') }}" class="btn btn-secondary" style="border-radius:8px;font-weight:600;">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
