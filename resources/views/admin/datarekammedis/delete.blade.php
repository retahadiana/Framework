
@extends('Layouts.lte.main')

@section('content')
<div class="page-section">
	<h2>Hapus Rekam Medis</h2>

	<div class="card p-3">
		<p>Anda akan menghapus rekam medis berikut. Tindakan ini tidak dapat dibatalkan.</p>

		<table class="table table-sm">
			<tr>
				<th>ID</th>
				<td>{{ $rekam->idrekam_medis ?? $rekam->id ?? '-' }}</td>
			</tr>
			<tr>
				<th>Waktu</th>
				<td>{{ optional($rekam->created_at)->format('Y-m-d H:i') ?? '-' }}</td>
			</tr>
			<tr>
				<th>Pet</th>
				<td>{{ $rekam->pet_nama ?? optional($rekam->pet)->nama ?? '-' }}</td>
			</tr>
			<tr>
				<th>Pemilik</th>
				<td>{{ $rekam->pemilik_nama ?? optional(optional($rekam->pet)->pemilik)->user->nama ?? '-' }}</td>
			</tr>
			<tr>
				<th>Dokter Pemeriksa</th>
				<td>{{ $rekam->dokter_nama ?? optional(optional($rekam->roleUser)->user)->nama ?? '-' }}</td>
			</tr>
		</table>

		<form method="POST" action="{{ route('datarekammedis.destroy', $rekam->idrekam_medis ?? $rekam->id ?? 0) }}">
			@csrf
			@method('DELETE')

			<div class="form-group">
				<button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus rekam medis ini?')">Hapus</button>
				<a href="{{ route('datarekammedis.index') }}" class="btn btn-secondary">Batal</a>
			</div>
		</form>
	</div>
</div>
@endsection
