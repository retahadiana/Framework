@extends('Layouts.lte.main')

@section('title', 'Edit Pemilik')
@section('page-title', 'Edit Pemilik')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-modern">
                <div class="card-header text-rshp">Form Edit Pemilik</div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('resepsionis.pemilik.update', $pemilik->idpemilik) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama', optional($pemilik->user)->nama) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', optional($pemilik->user)->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">No. WhatsApp</label>
                            <input id="no_wa" type="text" class="form-control" name="no_wa" value="{{ old('no_wa', $pemilik->no_wa) }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea id="alamat" class="form-control" name="alamat">{{ old('alamat', $pemilik->alamat) }}</textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-rshp">Simpan Perubahan</button>
                            <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
