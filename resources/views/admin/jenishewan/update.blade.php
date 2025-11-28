@extends('layouts.lte.main')
@section('content')

<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h3 class="mb-3">Edit Jenis Hewan</h3>

					<form action="{{ route('jenis-hewan.update', $item->idjenis_hewan) }}" method="POST">
						@csrf
						@method('PUT')

						<div class="form-group mb-3">
							<label for="nama_jenis_hewan">Nama Jenis Hewan</label>
							<input type="text" id="nama_jenis_hewan" name="nama_jenis_hewan" class="form-control @error('nama_jenis_hewan') is-invalid @enderror" value="{{ old('nama_jenis_hewan', $item->nama_jenis_hewan) }}">
							@error('nama_jenis_hewan')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="d-flex">
							<a href="{{ route('jenis-hewan.index') }}" class="btn btn-secondary">Kembali</a>
							<button type="submit" class="btn btn-primary ml-2">Simpan Perubahan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
