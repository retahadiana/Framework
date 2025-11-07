
@extends('Layouts.app')

@section('content')
<style>
.pet-header {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2996a7;
    margin-bottom: 18px;
}
.pet-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
    overflow: hidden;
}
.pet-table th {
    background: #2996a7;
    color: #fff;
    font-weight: 700;
    padding: 12px 10px;
    border: none;
}
.pet-table td {
    padding: 10px 10px;
    border-bottom: 1px solid #f2f2f2;
    font-size: 1rem;
}
.pet-table tr:last-child td {
    border-bottom: none;
}
.pet-action-link {
    color: #2996a7;
    font-weight: 600;
    margin-right: 10px;
    text-decoration: none;
    transition: color 0.2s;
}
.pet-action-link:hover {
    color: #e74c3c;
}
.pet-add-btn {
    background: #2ecc71;
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 8px;
    padding: 10px 24px;
    font-size: 1.1rem;
    margin-bottom: 18px;
    float: right;
    transition: background 0.2s;
    text-decoration: none;
    display: inline-block;
}
.pet-add-btn:hover {
    background: #27ae60;
}
.page-section {
    background: #f6fbfd;
    min-height: 100vh;
    padding: 40px 0 0 0;
}
</style>
<div class="page-section">
    <div class="container">
        <div class="pet-header">Manajemen Data Pet
            <a href="{{ route('pet.create') }}" class="pet-add-btn"><i class="fas fa-plus"></i> Tambah Pet</a>
        </div>
        <div class="table-responsive">
            <table class="pet-table">
                <thead>
                    <tr>
                        <th>ID Pet</th> 
                        <th>Nama Pet</th>
                        <th>Jenis</th>
                        <th>Kelamin</th>
                        <th>Tgl Lahir</th>
                        <th>Warna/Tanda</th>
                        <th>Ras</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->idpet }}</td>
                        <td>{{ $item->nama ?? $item->nama ?? '-' }}</td>
                        <td>
                            @if(isset($item->rasHewan->jenisHewan))
                                {{ $item->rasHewan->jenisHewan->nama_jenis_hewan }}
                            @else
                                {{ $item->jenis ?? '-' }}
                            @endif
                        </td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->tanggal_lahir }}</td>
                        <td>{{ $item->warna_tanda }}</td>
                        <td>{{ $item->rasHewan->nama_ras ?? '-' }}</td>
                        <td>{{ data_get($item, 'pemilik.user.nama') ?? data_get($item, 'pemilik.user.name') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('pet.edit', $item->idpet) }}" class="pet-action-link">Edit</a>
                            <form action="{{ route('pet.destroy', $item->idpet) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="pet-action-link" style="background:none;border:none;padding:0;cursor:pointer;" onclick="return confirm('Yakin hapus data pet?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
