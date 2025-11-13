@extends('Layouts.lte.main')

@section('content')
    <div class="page-section" style="background: #f6fbfd; min-height: 100vh; padding: 40px 0 0 0;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #2996a7; font-size: 2.2rem; font-weight: 700;">Manajemen Data User</h2>
            <a href="{{ route('user.create') }}" class="user-add-btn"><i class="fas fa-plus"></i> Tambah User</a>
        </div>
        <div class="table-responsive">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->iduser }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('user.edit', $item->iduser) }}" class="user-action-link user-edit">Edit</a>
                                <a href="{{ route('user.showResetPassword', $item->iduser) }}" class="user-action-link user-reset">Reset Password</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .user-add-btn {
            background: #2ecc71;
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-size: 1.1rem;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .user-add-btn:hover {
            background: #27ae60;
        }
        .user-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
            overflow: hidden;
            min-width: 900px;
        }
        .user-table th {
            background: #2996a7;
            color: #fff;
            font-weight: 700;
            padding: 12px 10px;
            border: none;
        }
        .user-table td {
            padding: 10px 10px;
            border-bottom: 1px solid #f2f2f2;
            font-size: 1rem;
        }
        .user-table tr:last-child td {
            border-bottom: none;
        }
        .user-action-link {
            color: #2996a7;
            font-weight: 600;
            margin-right: 10px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .user-action-link.user-edit:hover {
            color: #1677ff;
        }
        .user-action-link.user-reset {
            color: #e67e22;
        }
        .user-action-link.user-reset:hover {
            color: #e74c3c;
        }
        @media (max-width: 900px) {
            .user-table { min-width: 600px; }
        }
        @media (max-width: 600px) {
            .user-table { min-width: 400px; }
            .user-add-btn { padding: 8px 12px; font-size: 1rem; }
        }
    </style>
@endsection