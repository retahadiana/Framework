@extends('layouts.lte.main')

@section('content')

<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-md-6 col-lg-5">
			<div class="card">
				<div class="card-body">
					<h3 class="mb-3 text-center">Tambah Pemilik</h3>

					<form action="{{ route('pemilik.store') }}" method="POST">
						@csrf

						<div class="form-group mb-3">
							<label for="iduser">Pilih User Pemilik</label>
							<select name="iduser" id="iduser" class="form-control @error('iduser') is-invalid @enderror" onchange="fillNamaPemilik()" required>
								<option value="">-- Pilih User Pemilik --</option>
								@foreach($users as $user)
									<option value="{{ $user->iduser }}" data-nama="{{ $user->nama }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>{{ $user->nama }}</option>
								@endforeach
							</select>
							@error('iduser')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group mb-3">
							<label for="nama_pemilik">Nama Pemilik</label>
							<input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" value="{{ old('nama_pemilik') }}" readonly>
							@error('nama_pemilik')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group mb-3">
							<label for="no_wa">No. WhatsApp</label>
							<input type="text" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror" value="{{ old('no_wa') }}">
							@error('no_wa')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group mb-3">
							<label for="alamat">Alamat</label>
							<input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
							@error('alamat')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="d-flex justify-content-center">
							<button type="submit" class="btn btn-success">Simpan</button>
							<a href="{{ route('pemilik.index') }}" class="btn btn-secondary ml-2">Batal</a>
						</div>
					</form>

					<script>
						function fillNamaPemilik() {
							var select = document.getElementById('iduser');
							var selected = select.options[select.selectedIndex];
							document.getElementById('nama_pemilik').value = selected ? selected.getAttribute('data-nama') || '' : '';
						}
						document.addEventListener('DOMContentLoaded', function() {
							fillNamaPemilik();
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
