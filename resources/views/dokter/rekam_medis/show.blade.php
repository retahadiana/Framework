@extends('Layouts.lte.Dokter.main')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container page-section">
    <div class="mb-4">
        <h1 style="color:#38a3b7;font-weight:800;letter-spacing:-1px;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.5rem">
            <i class="fas fa-notes-medical"></i> Detail Rekam Medis
        </h1>
        <div style="height:3px;width:80px;background:linear-gradient(90deg,#38a3b7,#0891b2,#3b82f6);border-radius:2px;margin-bottom:1.5rem;"></div>
    </div>

    <div class="row g-4 mb-3">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius:16px;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4" style="color:#0891b2">Informasi Umum</h4>
                    @php
                        $visitTime = null;
                        if (optional($rekam->temuDokter)->waktu_daftar) {
                            $visitTime = optional($rekam->temuDokter)->waktu_daftar;
                        } elseif (isset($rekam->created_at)) {
                            $visitTime = $rekam->created_at;
                        }
                    @endphp
                    <dl class="row mb-0">
                        <dt class="col-5 text-muted">Waktu Kunjungan</dt>
                        <dd class="col-7">{{ $visitTime ? \Carbon\Carbon::parse($visitTime)->format('d F Y, H:i') : '-' }}</dd>
                        <dt class="col-5 text-muted">Nama Pasien</dt>
                        <dd class="col-7">{{ optional($rekam->pet)->nama ?? optional($rekam->pet)->nama_pet ?? '-' }}</dd>
                        <dt class="col-5 text-muted">Nama Pemilik</dt>
                        <dd class="col-7">{{ optional(optional($rekam->pet)->pemilik->user)->nama ?? '-' }}</dd>
                        <dt class="col-5 text-muted">Dokter Pemeriksa</dt>
                        <dd class="col-7">{{ optional(optional($rekam->roleUser)->user)->nama ?? '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius:16px;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4" style="color:#0891b2">Hasil Pemeriksaan</h4>
                    <dl class="row mb-0">
                        <dt class="col-5 text-muted">Anamnesa</dt>
                        <dd class="col-7">{!! nl2br(e($rekam->anamnesa ?? '-')) !!}</dd>
                        <dt class="col-5 text-muted">Temuan Klinis</dt>
                        <dd class="col-7">{!! nl2br(e($rekam->temuan_klinis ?? '-')) !!}</dd>
                        <dt class="col-5 text-muted">Diagnosa</dt>
                        <dd class="col-7">{!! nl2br(e($rekam->diagnosa ?? '-')) !!}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="margin-top:1.5rem;border-radius:16px;">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3" style="color:#0891b2">Tindakan & Terapi</h4>
            @if($rekam->detailRekamMedis->isEmpty())
                <p class="text-muted">Tidak ada tindakan atau terapi yang tercatat.</p>
            @else
                <div style="overflow:auto">
                    <table class="table table-modern" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekam->detailRekamMedis as $detail)
                                @php $kode = optional($detail->kodeTindakanTerapi); @endphp
                                <tr>
                                    <td>{{ optional($kode->kategori)->nama_kategori ?? '-' }}</td>
                                    <td>{{ $kode->kode ?? '-' }}</td>
                                    <td>{{ $kode->deskripsi_tindakan_terapi ?? ($detail->deskripsi ?? '-') }}</td>
                                    <td>{!! nl2br(e($detail->detail ?? '-')) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div style="margin-top:2rem;display:flex;justify-content:flex-end;">
        <a href="{{ route('dokter.rekam_medis.index') }}" class="button-secondary" style="border-radius:8px;padding:0.7rem 1.5rem;font-weight:600;">Kembali ke Daftar</a>
    </div>
</div>
@endsection
