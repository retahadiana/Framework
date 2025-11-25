@extends('Layouts.lte.main')

@section('content')
<div class="page-section">
    <h2>Buat Rekam Medis</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('datarekammedis.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="anamnesa">Anamnesa</label>
            <textarea name="anamnesa" id="anamnesa" class="form-control">{{ old('anamnesa') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="temuan_klinis">Temuan Klinis</label>
            <textarea name="temuan_klinis" id="temuan_klinis" class="form-control">{{ old('temuan_klinis') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="diagnosa">Diagnosa</label>
            <input type="text" name="diagnosa" id="diagnosa" class="form-control" value="{{ old('diagnosa') }}">
        </div>
        <div class="mb-3">
            <label for="dokter_pemeriksa">Dokter Pemeriksa</label>
            <input type="text" name="dokter_pemeriksa" id="dokter_pemeriksa" class="form-control" value="{{ old('dokter_pemeriksa') }}">
        </div>
        <div class="mb-3">
            <label for="idreservasi_dokter">ID Reservasi Dokter (opsional)</label>
            <input type="text" name="idreservasi_dokter" id="idreservasi_dokter" class="form-control" value="{{ old('idreservasi_dokter') }}">
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('datarekammedis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
