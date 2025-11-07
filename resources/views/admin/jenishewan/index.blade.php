@extends('Layouts.app')

@section('content')
<style>
    .jenis-card {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 0;
        overflow: hidden;
    }
    .jenis-header {
        background: #16b1e6;
        color: #fff;
        padding: 24px 32px 16px 32px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .jenis-header i {
        font-size: 2.5rem;
        background: #fff;
        color: #16b1e6;
        border-radius: 50%;
        padding: 10px;
        margin-right: 10px;
    }
    .jenis-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
    }
    .jenis-header p {
        font-size: 1.1rem;
        margin: 0;
        color: #e0f7fa;
    }
    .jenis-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    .jenis-table th {
        background: #b2ebf2;
        color: #222;
        font-weight: 700;
        padding: 16px 0;
        text-align: left;
    }
    .jenis-table td {
        padding: 14px 0;
        border-bottom: 1px solid #e0e0e0;
        font-size: 1.08rem;
    }
    .jenis-table th, .jenis-table td {
        padding-left: 32px;
        padding-right: 32px;
    }
    .aksi-btn {
        display: flex;
        gap: 8px;
    }
    .btn-edit {
        background: #1677ff;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 6px 18px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-edit:hover {
        background: #0056b3;
    }
    .btn-hapus {
        background: #e74c3c;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 6px 18px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-hapus:hover {
        background: #c0392b;
    }
    .btn-tambah {
        background: #27ae60;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 32px;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 24px auto 0 auto;
        display: block;
        box-shadow: 0 1px 4px rgba(39,174,96,0.08);
        transition: background 0.2s;
    }
    .btn-tambah:hover {
        background: #219150;
    }
    .btn-kembali {
        background: #16b1e6;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 24px 32px 24px 32px;
        display: inline-block;
        box-shadow: 0 1px 4px rgba(22,177,230,0.08);
        transition: background 0.2s;
        text-decoration: none;
    }
    .btn-kembali:hover {
        background: #0e7ca8;
    }
</style>

<div style="background: #e0f7fa; min-height: 100vh; padding-top: 32px;">
    <a href="{{ route('jenis-hewan.create') }}" class="btn-tambah">Tambah Jenis</a>
    <div class="jenis-card">
        <div class="jenis-header">
            <i class="fas fa-paw"></i>
            <div>
                <h2>Data Jenis Hewan</h2>
                <p>Daftar seluruh jenis hewan yang terdaftar</p>
            </div>
        </div>
        <table class="jenis-table">
            <thead>
                <tr>
                    <th>ID Jenis</th>
                    <th>Nama Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->idjenis_hewan }}</td>
                    <td>{{ $item->nama_jenis_hewan }}</td>
                    <td>
                        <div class="aksi-btn">
                            <a href="{{ route('jenis-hewan.edit', $item->idjenis_hewan) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('jenis-hewan.destroy', $item->idjenis_hewan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus jenis hewan ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url()->previous() }}" class="btn-kembali">&larr; Kembali</a>
    </div>
</div>
@endsection
