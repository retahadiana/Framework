@extends('Layouts.lte.main')

@section('content')
<div class="page-section" style="background: #f6fbfd; min-height: 100vh; padding: 40px 0 0 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #2996a7; font-size: 2.2rem; font-weight: 700;"><i class="fas fa-user-shield"></i> Daftar Role User</h2>
    </div>
    <div class="table-responsive">
        <table class="role-table">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                <tr>
                    <td>{{ $user->iduser }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>
                        @if($user->nama_role)
                            {{ $user->nama_role }} ({{ $user->role_status == 1 ? 'Aktif' : 'Non-Aktif' }})
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('role.create', ['iduser' => $user->iduser]) }}" class="role-action-link">Tambah Role</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>
    .role-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        overflow: hidden;
        min-width: 900px;
    }
    .role-table th {
        background: #2996a7;
        color: #ffffffff;
        font-weight: 700;
        padding: 14px 10px;
        border: none;
        font-size: 1.08rem;
    }
    .role-table td {
        padding: 12px 10px;
        border-bottom: 1px solid #e0e0e0;
        font-size: 1rem;
    }
    .role-table tr:last-child td {
        border-bottom: none;
    }
    .role-action-link {
        color: #2996a7;
        font-weight: 700;
        text-decoration: none;
        font-size: 1.08rem;
        transition: color 0.2s;
    }
    .role-action-link:hover {
        color: #e67e22;
        text-decoration: underline;
    }
    @media (max-width: 900px) {
        .role-table { min-width: 600px; }
    }
    @media (max-width: 600px) {
        .role-table { min-width: 400px; }
    }
</style>
@endsection
