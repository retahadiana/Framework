@extends('Layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container page-section">
    <h2>Detail Rekam Medis</h2>

    <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:1rem;">
        <div style="flex:1;min-width:280px;">
            <div class="page-section" style="padding:1.25rem;">
                <h3>Informasi Umum</h3>
                @php
                    $visitTime = null;
                    if (optional($rekam->temuDokter)->waktu_daftar) {
                        $visitTime = optional($rekam->temuDokter)->waktu_daftar;
                    } elseif (isset($rekam->created_at)) {
                        $visitTime = $rekam->created_at;
                    }
                @endphp
                <p><strong>Waktu Kunjungan:</strong>
                    {{ $visitTime ? \Carbon\Carbon::parse($visitTime)->format('d F Y, H:i') : '-' }}
                </p>
                <p><strong>Nama Pasien:</strong> {{ optional($rekam->pet)->nama ?? optional($rekam->pet)->nama_pet ?? '-' }}</p>
                <p><strong>Nama Pemilik:</strong> {{ optional(optional($rekam->pet)->pemilik->user)->name ?? '-' }}</p>
                <p><strong>Dokter Pemeriksa:</strong> {{ optional(optional($rekam->roleUser)->user)->nama ?? '-' }}</p>
            </div>
        </div>

        <div style="flex:1;min-width:320px;">
            <div class="page-section" style="padding:1.25rem;">
                <h3>Hasil Pemeriksaan</h3>
                <p><strong>Anamnesa:</strong></p>
                <p>{!! nl2br(e($rekam->anamnesa ?? '-')) !!}</p>
                <hr>
                <p><strong>Temuan Klinis:</strong></p>
                <p>{!! nl2br(e($rekam->temuan_klinis ?? '-')) !!}</p>
                <hr>
                <p><strong>Diagnosa:</strong></p>
                <p>{!! nl2br(e($rekam->diagnosa ?? '-')) !!}</p>
            </div>
        </div>
    </div>

    <div class="page-section" style="margin-top:1.5rem;">
        <h3>Tindakan & Terapi</h3>
        @if($rekam->detailRekamMedis->isEmpty())
            <p>Tidak ada tindakan atau terapi yang tercatat.</p>
        @else
            <div style="overflow:auto">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="text-align:left;border-bottom:1px solid #e5e7eb;padding:0.5rem 0;">
                            <th style="padding:0.5rem">Kategori</th>
                            <th style="padding:0.5rem">Kode</th>
                            <th style="padding:0.5rem">Deskripsi</th>
                            <th style="padding:0.5rem">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekam->detailRekamMedis as $detail)
                            @php $kode = optional($detail->kodeTindakanTerapi); @endphp
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:0.5rem">{{ optional($kode->kategori)->nama_kategori ?? '-' }}</td>
                                <td style="padding:0.5rem">{{ $kode->kode ?? '-' }}</td>
                                <td style="padding:0.5rem">{{ $kode->deskripsi_tindakan_terapi ?? ($detail->deskripsi ?? '-') }}</td>
                                <td style="padding:0.5rem">{!! nl2br(e($detail->detail ?? '-')) !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div style="margin-top:1rem;">
        <a href="{{ route('dokter.rekam_medis.index') }}" class="button-secondary">Kembali ke Daftar</a>
    </div>
</div>
@endsection
