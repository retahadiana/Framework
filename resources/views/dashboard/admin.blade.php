@extends('Layouts.lte.main')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold text-primary">Selamat datang di Dashboard Admin</h1>
    <p class="text-muted">Halo, {{ auth()->user()->email }}!</p>

    <div class="data-master-section mt-4">
        <h5 class="card-title text-primary mb-3" style="font-size:1.3rem;font-weight:700;">Data Master</h5>
        <div class="data-master-grid">
            <a href="{{ route('user.index') }}" class="data-master-card">
                <i class="fas fa-users"></i>
                <span>Data User</span>
            </a>
            <a href="{{ route('role.index') }}" class="data-master-card">
                <i class="fas fa-user-shield"></i>
                <span>Manajemen Role</span>
            </a>
            <a href="{{ route('jenis-hewan.index') }}" class="data-master-card">
                <i class="fas fa-dog"></i>
                <span>Jenis Hewan</span>
            </a>
            <a href="{{ route('ras-hewan.index') }}" class="data-master-card">
                <i class="fas fa-paw"></i>
                <span>Ras Hewan</span>
            </a>
            <a href="{{ route('pemilik.index') }}" class="data-master-card">
                <i class="fas fa-address-card"></i>
                <span>Data Pemilik</span>
            </a>
            <a href="{{ route('pet.index') }}" class="data-master-card">
                <i class="fas fa-cat"></i>
                <span>Data Pet</span>
            </a>
            <a href="{{ route('kategori.index') }}" class="data-master-card">
                <i class="fas fa-tags"></i>
                <span>Data Kategori</span>
            </a>
            <a href="{{ route('kategori-klinis.index') }}" class="data-master-card">
                <i class="fas fa-clinic-medical"></i>
                <span>Data Kategori Klinik</span>
            </a>
            <a href="{{ route('kode-tindakan-terapi.index') }}" class="data-master-card">
                <i class="fas fa-file-medical-alt"></i>
                <span>Data Kode Tindakan</span>
            </a>
        </div>
    </div>
    <style>
        .data-master-section {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
            padding: 32px 24px 32px 24px;
            margin: 0 auto 32px auto;
            max-width: 1200px;
        }
        .data-master-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 28px;
            margin-top: 18px;
        }
        .data-master-card {
            background: #f6fbfd;
            border-radius: 16px;
            box-shadow: 0 1px 4px rgba(44, 62, 80, 0.06);
            padding: 36px 0 24px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #2996a7;
            font-weight: 700;
            font-size: 1.18rem;
            transition: box-shadow 0.2s, background 0.2s, color 0.2s;
            border: 2px solid #e0f7fa;
        }
        .data-master-card:hover {
            background: #e0f7fa;
            color: #1677ff;
            box-shadow: 0 4px 16px rgba(44, 62, 80, 0.13);
        }
        .data-master-card i {
            font-size: 2.7rem;
            margin-bottom: 18px;
            color: #2996a7;
            transition: color 0.2s;
        }
        .data-master-card:hover i {
            color: #1677ff;
        }
        .data-master-card span {
            display: block;
            margin-top: 2px;
        }
        @media (max-width: 700px) {
            .data-master-section {
                padding: 16px 4px;
            }
            .data-master-grid {
                gap: 14px;
            }
            .data-master-card {
                padding: 22px 0 14px 0;
                font-size: 1rem;
            }
            .data-master-card i {
                font-size: 2rem;
                margin-bottom: 10px;
            }
        }
    </style>
</div>
@endsection
