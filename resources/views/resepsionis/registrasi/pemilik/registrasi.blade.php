@extends('Layouts.lte.main')

@section('title', 'Registrasi Pemilik')
@section('page-title', 'Registrasi Pemilik')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-modern">
                <div class="card-header text-rshp">Form Registrasi Pemilik</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('resepsionis.pemilik.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_wa" class="form-label">No. WhatsApp</label>
                            <input id="no_wa" type="text" class="form-control" name="no_wa" value="{{ old('no_wa') }}" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-rshp">Daftarkan Pemilik</button>
                            <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
