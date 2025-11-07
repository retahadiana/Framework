@extends('Layouts.app')
@section('content')
<div class="page-section">
    <h2><i class="fas fa-heart"></i> Edit Pet</h2>
    <form action="{{ route('pet.update', $item->idpet) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group">
                <label for="nama">Nama Pet</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $item->nama) }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $item->tanggal_lahir) }}">
                @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="warna_tanda">Warna/Tanda</label>
                <input type="text" name="warna_tanda" class="form-control @error('warna_tanda') is-invalid @enderror" value="{{ old('warna_tanda', $item->warna_tanda) }}">
                @error('warna_tanda')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                    <option value="J" {{ old('jenis_kelamin', $item->jenis_kelamin) == 'J' ? 'selected' : '' }}>Jantan</option>
                    <option value="B" {{ old('jenis_kelamin', $item->jenis_kelamin) == 'B' ? 'selected' : '' }}>Betina</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="idpemilik">Pemilik</label>
                <select name="idpemilik" class="form-control @error('idpemilik') is-invalid @enderror">
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}" {{ old('idpemilik', $item->idpemilik) == $p->idpemilik ? 'selected' : '' }}>{{ $p->user->nama ?? $p->user->name }}</option>
                    @endforeach
                </select>
                @error('idpemilik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="idras_hewan">Ras Hewan</label>
                <select name="idras_hewan" class="form-control @error('idras_hewan') is-invalid @enderror">
                    @foreach($rasHewan as $ras)
                        <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan', $item->idras_hewan) == $ras->idras_hewan ? 'selected' : '' }}>{{ $ras->nama_ras }}</option>
                    @endforeach
                </select>
                @error('idras_hewan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group mt-3">
            <a href="{{ route('pet.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
