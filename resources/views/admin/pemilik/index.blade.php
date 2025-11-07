@extends('Layouts.app')

@section('content')
<style>
    .pemilik-card {
        max-width: 1200px;
        margin: 40px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 0;
        overflow: hidden;
    }
    .pemilik-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #16b1e6;
        margin-bottom: 18px;
        margin-top: 32px;
        text-align: left;
        margin-left: 32px;
    }
    .pemilik-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    .pemilik-table th {
        background: #43b0c1;
        color: #fff;
        font-weight: 700;
        padding: 16px 0;
        text-align: left;
        font-size: 1.1rem;
    }
    .pemilik-table th, .pemilik-table td {
        padding-left: 32px;
        padding-right: 32px;
    }
    .pemilik-table td {
        padding: 14px 0;
        border-bottom: 1px solid #e0e0e0;
        font-size: 1.08rem;
    }
    .aksi-btn {
        display: flex;
        gap: 8px;
        margin-bottom: 4px;
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
        text-decoration: none;
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
        text-decoration: none;
    }
    .btn-hapus:hover {
        background: #c0392b;
    }
    .btn-tambah-pemilik {
        background: #27ae60;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 32px;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 24px 32px 0 0;
        float: right;
        box-shadow: 0 1px 4px rgba(39,174,96,0.08);
        transition: background 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-tambah-pemilik:hover {
        background: #219150;
    }
</style>
<div style="background: #f6fbfd; min-height: 100vh; padding-top: 40px;">
    <div class="pemilik-title">Manajemen Data Pemilik
        <a href="{{ route('pemilik.create') }}" class="btn-tambah-pemilik">&#43; Tambah Pemilik</a>
    </div>
    <div class="pemilik-card">
        <table class="pemilik-table">
            <thead>
                <tr>
                    <th>ID Pemilik</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. WhatsApp</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->idpemilik }}</td>
                    <td>{{ $item->user->nama ?? $item->nama_pemilik }}</td>
                    <td>{{ $item->user->email ?? '-' }}</td>
                    <td>{{ $item->no_wa }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <div class="aksi-btn">
                            <a href="{{ route('pemilik.edit', $item->idpemilik) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('pemilik.destroy', $item->idpemilik) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus pemilik ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
