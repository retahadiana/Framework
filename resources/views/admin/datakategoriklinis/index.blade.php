@extends('Layouts.lte.main')
@section('content')
@include('partials.table-standard')
@include('partials.action-buttons')
<div class="page-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #319da7;"><i class="fas fa-stethoscope"></i> Manajemen Data Kategori Klinis</h2>
        <a href="{{ route('kategori-klinis.create') }}" class="btn btn-success action-create" style="border-radius: 8px; font-weight: 600; background: #0bae51ff;">
            <i class="fas fa-plus"></i> Tambah Kategori Klinis
        </a>
    </div>
    <div class="table-responsive" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 24px; max-width: 1100px; margin: auto;">
        <table class="table-standard" style="font-size: 1.15rem;">
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
                        <a href="{{ route('kategori-klinis.edit', $item->idkategori_klinis) }}" class="action-edit">Edit</a>
                        <a href="{{ route('kategori-klinis.delete', $item->idkategori_klinis) }}" class="action-delete">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
