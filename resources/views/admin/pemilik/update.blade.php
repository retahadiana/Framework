@extends('layouts.lte.main')
@section('content')

<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-md-6 col-lg-5">
			<div class="card">
				<div class="card-body">
					<h3 class="mb-2">Edit Data Pemilik</h3>
					<p class="text-muted mb-3">Mengedit data untuk: <strong>{{ $item->nama_user ?? '-' }}</strong></p>

					<form action="{{ route('pemilik.update', $item->idpemilik) }}" method="POST">
						@csrf
						@method('PUT')

						<div class="form-group mb-3">
							<label for="nama_pemilik">Nama</label>
							<input type="text" id="nama_pemilik" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" value="{{ old('nama_pemilik', $item->nama_user ?? '-') }}" readonly>
							@error('nama_pemilik')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group mb-3">
							<label for="email">Email</label>
							<input type="text" id="email" name="email" class="form-control" value="{{ $item->email_user ?? '-' }}" readonly>
						</div>

						<div class="form-group mb-3">
							<label for="no_wa">Nomor WhatsApp</label>
							<input type="text" id="no_wa" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror" value="{{ old('no_wa', $item->no_wa) }}">
							@error('no_wa')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group mb-3">
							<label for="alamat">Alamat</label>
							<textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="4">{{ old('alamat', $item->alamat) }}</textarea>
							@error('alamat')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="d-flex">
							<a href="{{ route('pemilik.index') }}" class="btn btn-secondary">Batal</a>
							<button type="submit" class="btn btn-primary ml-2">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
