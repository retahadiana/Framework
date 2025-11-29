@extends('Layouts.lte.main')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="container page-section">
    <div class="mb-4">
        <h2 style="color:#38a3b7;font-weight:800;letter-spacing:-1px;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.7rem">
            <i class="fas fa-notes-medical"></i> Edit Rekam Medis
        </h2>
        <div style="height:3px;width:100px;background:linear-gradient(90deg,#38a3b7,#0891b2,#3b82f6);border-radius:2px;margin-bottom:1.5rem;"></div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius:18px;max-width:700px;margin:0 auto;">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('perawat.rekam_medis.update', $rekamMedis->idrekam_medis) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="anamnesa" class="form-label fw-semibold">Anamnesa</label>
                    <textarea name="anamnesa" id="anamnesa" class="form-control" required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="temuan_klinis" class="form-label fw-semibold">Temuan Klinis</label>
                    <textarea name="temuan_klinis" id="temuan_klinis" class="form-control" required>{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="diagnosa" class="form-label fw-semibold">Diagnosa</label>
                    <textarea name="diagnosa" id="diagnosa" class="form-control" required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary" style="border-radius:8px;font-weight:600;">Simpan Perubahan</button>
                    <a href="{{ route('perawat.rekam_medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-secondary" style="border-radius:8px;font-weight:600;">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    @if($rekamMedis->detailRekamMedis->isNotEmpty())
    <div class="card shadow-sm border-0 mt-4" style="border-radius:18px;max-width:900px;margin:0 auto;">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Daftar Detail Tindakan Terapi</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead style="background:#0891b2;color:#fff;">
                        <tr>
                            <th style="width:60px">No</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedis->detailRekamMedis as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->kode ?? '-' }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}</td>
                            <td>{{ $detail->detail ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
