@extends('layouts.lte.perawat.main')

@section('content')
<div class="container page-section">
    <div class="mb-4">
        <h2 style="color:#38a3b7;font-weight:800;letter-spacing:-1px;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.7rem">
            <i class="fas fa-procedures"></i> Daftar Kode Tindakan Terapi
        </h2>
        <div style="height:3px;width:100px;background:linear-gradient(90deg,#38a3b7,#0891b2,#3b82f6);border-radius:2px;margin-bottom:1.5rem;"></div>
    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius:18px;background:linear-gradient(120deg,#e0f7fa 60%,#f0f9ff 100%);">
        <div class="card-body text-center py-4">
            <h3 style="margin:0;font-weight:700;color:#0891b2;letter-spacing:1px;">RUMAH SAKIT HEWAN PENDIDIKAN</h3>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius:18px;">
        <div class="card-body">
            <p class="text-muted mb-3">Berikut daftar kode tindakan terapi yang tersedia. Gunakan tabel untuk melihat rincian kategori dan kategori klinis.</p>

            <div class="table-responsive">
                <table class="table table-modern" style="width:100%;">
                    <thead style="background:#0891b2;color:#fff;">
                        <tr style="border-top-left-radius:12px;border-top-right-radius:12px;">
                            <th>ID</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Kategori Klinis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr style="background:rgba(8,145,178,0.03);">
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
@endsection
