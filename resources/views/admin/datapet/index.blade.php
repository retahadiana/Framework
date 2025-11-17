
@extends('Layouts.lte.main')

@section('content')
@include('partials.table-standard')
@include('partials.action-buttons')
<style>
.pet-header {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2996a7;
    margin-bottom: 18px;
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
.pet-action-delete {
    color: #e74c3c;
}
.pet-action-delete:hover {
    color: #c0392b;
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
            <a href="{{ route('pet.create') }}" class="pet-add-btn action-create"><i class="fas fa-plus"></i> Tambah Pet</a>
        </div>
        <div class="table-responsive">
            <table class="table-standard">
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
                            {{ $item->nama_jenis_hewan ?? '-' }}
                        </td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->tanggal_lahir }}</td>
                        <td>{{ $item->warna_tanda }}</td>
                        <td>{{ $item->nama_ras ?? '-' }}</td>
                        <td>{{ $item->nama_pemilik ?? '-' }}</td>
                        <td>
                            <a href="{{ route('pet.edit', $item->idpet) }}" class="pet-action-link action-edit">Edit</a>
                            <form action="{{ route('pet.destroy', $item->idpet) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="pet-action-link pet-action-delete action-delete" style="background:none;border:none;padding:0;cursor:pointer;" onclick="return confirm('Yakin hapus data pet?')">Hapus</button>
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
