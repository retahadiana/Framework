@extends('layouts.admin')
@section('content')
<style>
	.pemilik-create-card {
		max-width: 420px;
		margin: 60px auto;
		background: #fff;
		border-radius: 20px;
		box-shadow: 0 2px 12px rgba(0,0,0,0.08);
		padding: 40px 32px 32px 32px;
		text-align: center;
	}
	.pemilik-create-title {
		font-size: 2rem;
		font-weight: 700;
		color: #1a3365;
		margin-bottom: 32px;
	}
	.pemilik-create-label {
		font-weight: 500;
		font-size: 1.1rem;
		color: #1a3365;
		margin-bottom: 10px;
		text-align: left;
		display: block;
	}
	.pemilik-create-input {
		width: 100%;
		padding: 16px;
		border-radius: 12px;
		border: 1px solid #e0e0e0;
		margin-bottom: 28px;
		font-size: 1.1rem;
		background: #f9fafb;
	}
	.pemilik-create-btn-row {
		display: flex;
		gap: 18px;
		justify-content: center;
		margin-top: 10px;
	}
	.pemilik-create-btn-simpan {
		background: #27ae60;
		color: #fff;
		border: none;
		border-radius: 10px;
		padding: 18px 0;
		font-size: 1.2rem;
		font-weight: 700;
		width: 48%;
		box-shadow: 0 1px 4px rgba(39,174,96,0.08);
		transition: background 0.2s;
	}
	.pemilik-create-btn-simpan:hover {
		background: #219150;
	}
	.pemilik-create-btn-batal {
		background: #7b8a8b;
		color: #fff;
		border: none;
		border-radius: 10px;
		padding: 18px 0;
		font-size: 1.2rem;
		font-weight: 700;
		width: 48%;
		box-shadow: 0 1px 4px rgba(123,138,139,0.08);
		transition: background 0.2s;
		text-decoration: none;
		display: inline-block;
	}
	.pemilik-create-btn-batal:hover {
		background: #566363;
	}
</style>
<div style="background: #f6fbfd; min-height: 100vh; padding-top: 40px;">
	<div class="pemilik-create-card">
		<div class="pemilik-create-title">Tambah Pemilik</div>
		<form action="{{ route('pemilik.store') }}" method="POST">
			@csrf
				<label for="iduser" class="pemilik-create-label">Pilih User Pemilik</label>
				<select name="iduser" id="iduser" class="pemilik-create-input @error('iduser') is-invalid @enderror" onchange="fillNamaPemilik()" required>
					<option value="">-- Pilih User Pemilik --</option>
							@foreach($users as $user)
								<option value="{{ $user->iduser }}" data-nama="{{ $user->nama }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>{{ $user->nama }}</option>
					@endforeach
				</select>
				@error('iduser')
					<div class="invalid-feedback" style="color:#e74c3c;text-align:left;margin-bottom:10px;">{{ $message }}</div>
				@enderror

				<label for="nama_pemilik" class="pemilik-create-label">Nama Pemilik</label>
				<input type="text" name="nama_pemilik" id="nama_pemilik" class="pemilik-create-input @error('nama_pemilik') is-invalid @enderror" value="{{ old('nama_pemilik') }}" readonly>
				@error('nama_pemilik')
					<div class="invalid-feedback" style="color:#e74c3c;text-align:left;margin-bottom:10px;">{{ $message }}</div>
				@enderror

				<script>
				function fillNamaPemilik() {
					var select = document.getElementById('iduser');
					var selected = select.options[select.selectedIndex];
					document.getElementById('nama_pemilik').value = selected.getAttribute('data-nama') || '';
				}
				// Auto-fill if old value exists
				document.addEventListener('DOMContentLoaded', function() {
					fillNamaPemilik();
				});
				</script>
			<label for="no_wa" class="pemilik-create-label">No. WhatsApp</label>
			<input type="text" name="no_wa" class="pemilik-create-input @error('no_wa') is-invalid @enderror" value="{{ old('no_wa') }}">
			@error('no_wa')
				<div class="invalid-feedback" style="color:#e74c3c;text-align:left;margin-bottom:10px;">{{ $message }}</div>
			@enderror
			<label for="alamat" class="pemilik-create-label">Alamat</label>
			<input type="text" name="alamat" class="pemilik-create-input @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
			@error('alamat')
				<div class="invalid-feedback" style="color:#e74c3c;text-align:left;margin-bottom:10px;">{{ $message }}</div>
			@enderror
			<div class="pemilik-create-btn-row">
				<button type="submit" class="pemilik-create-btn-simpan">Simpan</button>
				<a href="{{ route('pemilik.index') }}" class="pemilik-create-btn-batal">Batal</a>
			</div>
		</form>
	</div>
</div>
@endsection
