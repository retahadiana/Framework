@extends('Layouts.lte.main')
@section('content')
<div class="page-section">
    <h2><i class="fas fa-heart"></i> Hapus Pet</h2>
    <form action="{{ route('admin.pet.destroy', $item->idpet) }}" method="POST">
        @csrf
        @method('DELETE')
        <p>Apakah Anda yakin ingin menghapus data pet <strong>{{ $item->nama_var }}</strong>?</p>
        <div class="form-group mt-3">
            <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
    </form>
</div>
@endsection
