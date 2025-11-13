@extends('Layouts.lte.main')

@section('content')

<div class="page-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #319da7;"><i class="fas fa-procedures"></i> Manajemen Kode Tindakan & Terapi</h2>
        <a href="{{ route('kode-tindakan-terapi.create') }}" class="btn btn-success" style="border-radius: 8px; font-weight: 600; background: #2ecc71;">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    <div class="table-responsive" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 24px; max-width: 1100px; margin: auto;">
        <table class="table" style="border-radius: 8px; overflow: hidden; min-width: 1000px; font-size: 1.15rem;">
            <thead style="background: #319da7; color: #fff;">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th style="width: 120px;">Kode</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Kategori Klinis</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->idkode_tindakan_terapi }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                    <td>{{ $item->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->nama_kategori_klinis ?? '-' }}</td>
                    <td>
                        <a href="{{ route('kode-tindakan-terapi.edit', $item->idkode_tindakan_terapi) }}" style="color: #319da7; font-weight: 600; margin-right: 12px;">Edit</a>
                        <a href="{{ route('kode-tindakan-terapi.delete', $item->idkode_tindakan_terapi) }}" style="color: #e74c3c; font-weight: 600;">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
