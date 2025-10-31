@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="page-section">
        <h2><i class="fas fa-file-medical"></i> Daftar Rekam Medis</h2>

        <div class="card mb-4" style="box-shadow:none;border:none;">
            <div class="card-body text-center py-4" style="background:transparent;padding:2rem 1rem;">
                <div style="max-width:1000px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:1rem;">
                    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNAIR-seal.png" alt="Unair" style="height:72px;">
                    <div style="flex:1;text-align:center">
                        <h3 style="margin:0;font-weight:700;color:var(--neutral-700)">RUMAH SAKIT HEWAN PENDIDIKAN</h3>
                    </div>
                    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/rshp-logo.png" alt="RSHP" style="height:72px;">
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <p class="text-muted">Berikut daftar rekam medis. Gunakan tombol aksi untuk melihat atau mengubah data.</p>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Waktu Kunjungan</th>
                                <th>Nama Pasien</th>
                                <th>Nama Pemilik</th>
                                <th>Anamnesa</th>
                                <th>Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $rekamMedis)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rekamMedis->created_at ? $rekamMedis->created_at->format('d-m-Y H:i') : '-' }}</td>
                                <td>{{ $rekamMedis->pet->nama_pet ?? 'N/A' }}</td>
                                <td>{{ $rekamMedis->pet->pemilik->user->name ?? 'N/A' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($rekamMedis->anamnesa ?? '-', 100) }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($rekamMedis->diagnosa ?? '-', 100) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data rekam medis</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
