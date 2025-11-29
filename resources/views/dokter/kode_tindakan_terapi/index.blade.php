@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="page-section">
        <h2><i class="fas fa-procedures"></i> Daftar Kode Tindakan Terapi</h2>

        <!-- Decorative banner with logos (matches other pages) -->
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
                <p class="text-muted">Berikut daftar kode tindakan terapi yang tersedia. Gunakan tabel untuk melihat rincian kategori dan kategori klinis.</p>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Kategori Klinis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                            <tr>
                                <td>{{ $item->idkode_tindakan_terapi }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                                <td>{{ $item->kategori->nama_kategori ?? 'N/A' }}</td>
                                <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data tersedia.</td>
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

