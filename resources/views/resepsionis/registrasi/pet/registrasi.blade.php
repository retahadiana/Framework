@extends('Layouts.lte.resepsionis.main')

@section('title', 'Registrasi Pet')
@section('page-title', 'Registrasi Pet')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-modern">
                <div class="card-header text-rshp">Form Registrasi Pet</div>

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

                    <form method="POST" action="{{ route('resepsionis.pet.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_pet" class="form-label">Nama Pet</label>
                            <input id="nama_pet" type="text" class="form-control" name="nama_pet" value="{{ old('nama_pet') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input id="tgl_lahir" type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="warna_tanda" class="form-label">Warna / Tanda</label>
                            <textarea id="warna_tanda" class="form-control" name="warna_tanda">{{ old('warna_tanda') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select id="jenis_kelamin" class="form-select" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                                <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="idpemilik" class="form-label">Pemilik</label>
                            <select id="idpemilik" class="form-select" name="idpemilik" required>
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach($pemilikList as $pemilik)
                                    <option value="{{ $pemilik->idpemilik }}" {{ old('idpemilik') == $pemilik->idpemilik ? 'selected' : '' }}>{{ $pemilik->nama_pemilik }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="idras_hewan" class="form-label">Ras Hewan</label>
                            <select id="idras_hewan" class="form-select" name="idras_hewan" required>
                                <option value="">-- Pilih Ras Hewan --</option>
                                @foreach($rasList as $ras)
                                    <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>{{ optional($ras->jenisHewan)->nama_jenis_hewan ? optional($ras->jenisHewan)->nama_jenis_hewan . ' - ' . $ras->nama_ras : $ras->nama_ras }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-rshp">Daftarkan Pet</button>
                            <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
