@extends('Layouts.lte.main')
@section('content')
<div class="page-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #319da7;"><i class="fas fa-stethoscope"></i> Manajemen Data Kategori Klinis</h2>
        <a href="{{ route('kategori-klinis.create') }}" class="btn btn-success" style="border-radius: 8px; font-weight: 600; background: #b2f1f7ff;">
            <i class="fas fa-plus"></i> Tambah Kategori Klinis
        </a>
    </div>
    <div class="table-responsive" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 24px; max-width: 1100px; margin: auto;">
        <table class="table" style="border-radius: 8px; overflow: hidden; min-width: 1000px; font-size: 1.15rem;">
            <thead style="background: #319da7; color: #fff;">
                <tr>
                    <th style="width: 80px;">#</th>
                    <th>Nama Kategori Klinis</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->idkategori_klinis }}</td>
                    <td>{{ $item->nama_kategori_klinis }}</td>
                    <td>
                        <a href="{{ route('kategori-klinis.edit', $item->idkategori_klinis) }}" style="color: #319da7; font-weight: 600; margin-right: 12px;">Edit</a>
                        <a href="{{ route('kategori-klinis.delete', $item->idkategori_klinis) }}" style="color: #e74c3c; font-weight: 600;">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
