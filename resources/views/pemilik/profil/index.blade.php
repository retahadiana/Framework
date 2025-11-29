@extends('Layouts.lte.main')

@section('content')
    <div class="container mt-4">
        <nav class="breadcrumb small">Anda di: <a href="{{ route('pemilik.dashboard') }}">Dashboard</a> &raquo; Profil</nav>
        <div class="page-header-accent mb-2"><span class="accent-dot"></span><h1 class="h5 mb-0 text-rshp">Profil Pemilik</h1></div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card card-modern p-3">
            <form method="POST" action="{{ route('pemilik.profil.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required value="{{ old('nama', $user->nama ?? '') }}">
                    @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email ?? '') }}">
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">No. WA</label>
                    <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa', $pemilik->no_wa ?? '') }}">
                    @error('no_wa') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="4">{{ old('alamat', $pemilik->alamat ?? '') }}</textarea>
                    @error('alamat') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-rshp">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
