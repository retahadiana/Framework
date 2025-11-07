@extends('Layouts.app')

@section('content')
<style>
    .ras-card {
        max-width: 1000px;
        margin: 40px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 0;
        overflow: hidden;
    }
    .ras-header {
        background: #16b1e6;
        color: #fff;
        padding: 24px 32px 16px 32px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .ras-header i {
        font-size: 2.5rem;
        background: #fff;
        color: #16b1e6;
        border-radius: 50%;
        padding: 10px;
        margin-right: 10px;
    }
    .ras-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
    }
    .ras-header p {
        font-size: 1.1rem;
        margin: 0;
        color: #e0f7fa;
    }
    .ras-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    .ras-table th {
        background: #b2ebf2;
        color: #222;
        font-weight: 700;
        padding: 16px 0;
        text-align: left;
    }
    .ras-table th, .ras-table td {
        padding-left: 32px;
        padding-right: 32px;
    }
    .ras-table td {
        padding: 14px 0;
        border-bottom: 1px solid #e0e0e0;
        font-size: 1.08rem;
        vertical-align: top;
    }
    .aksi-btn {
        display: flex;
        gap: 8px;
        margin-bottom: 4px;
    }
    .btn-update {
        background: #1677ff;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 4px 14px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-update:hover {
        background: #0056b3;
    }
    .btn-delete {
        background: #e74c3c;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 4px 14px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-delete:hover {
        background: #c0392b;
    }
    .btn-tambah-ras {
        background: #27ae60;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 0 0;
        box-shadow: 0 1px 4px rgba(39,174,96,0.08);
        transition: background 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-tambah-ras:hover {
        background: #219150;
    }
</style>

<div style="background: #e0f7fa; min-height: 100vh; padding-top: 32px;">
    <div class="ras-card">
        <div class="ras-header">
            <i class="fas fa-dog"></i>
            <div>
                <h2>Data Ras Hewan</h2>
                <p>Daftar seluruh ras hewan beserta jenisnya</p>
            </div>
        </div>
        <table class="ras-table">
            <thead>
                <tr>
                    <th>ID Jenis</th>
                    <th>Nama Jenis Hewan</th>
                    <th>Daftar Ras</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $jenisList = $data->groupBy('idjenis_hewan');
                @endphp
                @foreach ($jenisList as $idjenis => $rasList)
                    @php $jenis = $rasList->first()->jenisHewan; @endphp
                    <tr>
                        <td>{{ $jenis->idjenis_hewan ?? '-' }}</td>
                        <td>{{ $jenis->nama_jenis_hewan ?? '-' }}</td>
                        <td>
                            <ul style="margin:0;padding-left:18px;">
                                @foreach ($rasList as $ras)
                                    <li style="margin-bottom:4px;">
                                        {{ $ras->nama_ras }}
                                        <span class="aksi-btn">
                                            <a href="{{ route('ras-hewan.edit', $ras->idras_hewan) }}" class="btn-update">Update</a>
                                            <form action="{{ route('ras-hewan.destroy', $ras->idras_hewan) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus ras ini?')">Delete</button>
                                            </form>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('ras-hewan.create') }}" class="btn-tambah-ras">&#43; Tambah Ras</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
