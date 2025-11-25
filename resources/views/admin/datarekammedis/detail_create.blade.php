@extends('Layouts.lte.main')

@section('content')
<div class="page-section">
    <h2>Tambah Detail untuk Rekam Medis #{{ $rekam->idrekam_medis }}</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('datarekammedis.detail.store', $rekam->idrekam_medis) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="idkode_tindakan_terapi">ID Kode Tindakan Terapi (opsional)</label>
            <input type="text" name="idkode_tindakan_terapi" id="idkode_tindakan_terapi" class="form-control" value="{{ old('idkode_tindakan_terapi') }}">
        </div>
        <div class="mb-3">
            <label for="detail">Detail</label>
            <textarea name="detail" id="detail" class="form-control">{{ old('detail') }}</textarea>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('datarekammedis.show', $rekam->idrekam_medis) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
