<!DOCTYPE html>
<html>
<head>
    <title>Admin Layout</title>
    <link rel="stylesheet" href="{{ asset('layout/style.css') }}">
</head>
<body>
    @yield('content')
</body>
</html>

<!-- TAMBAH USER -->
<style>
    .form-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        max-width: 400px;
        margin: 40px auto;
        padding: 32px 32px 24px 32px;
        text-align: center;
    }
    .form-card h2 {
        font-size: 2rem;
        font-weight: bold;
        color: #1a2a4a;
        margin-bottom: 32px;
    }
    .form-card label {
        text-align: left;
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #444;
    }
    .form-card input[type="text"],
    .form-card input[type="email"],
    .form-card input[type="password"] {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        margin-bottom: 20px;
        font-size: 1rem;
    }
    .form-card .btn-row {
        display: flex;
        gap: 16px;
        justify-content: center;
        margin-top: 16px;
    }
    .form-card .btn-success {
        background: #22b573;
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        padding: 16px 0;
        width: 48%;
        font-size: 1.2rem;
        cursor: pointer;
    }
    .form-card .btn-secondary {
        background: #8a999e;
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        padding: 16px 0;
        width: 48%;
        font-size: 1.2rem;
        cursor: pointer;
    }
</style>

<!-- EDIT UESER -->
<style>
    .edit-card {
        max-width: 400px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 32px 28px 24px 28px;
    }
    .edit-card h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 24px;
    }
    .edit-card label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    .edit-card input[type="text"],
    .edit-card input[type="email"] {
        width: 100%;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        margin-bottom: 18px;
        font-size: 1rem;
        background: #f9fafb;
    }
    .edit-card .btn-row {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 10px;
    }
    .edit-card .btn-primary {
        background: #1677ff;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: 600;
        box-shadow: 0 1px 4px rgba(22,119,255,0.08);
        transition: background 0.2s;
    }
    .edit-card .btn-primary:hover {
        background: #0056b3;
    }
    .edit-card .btn-secondary {
        background: #6c757d;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: 600;
        box-shadow: 0 1px 4px rgba(108,117,125,0.08);
        transition: background 0.2s;
    }
    .edit-card .btn-secondary:hover {
        background: #495057;
    }
</style>

<!-- RESET PASSWORD USER -->
<style>
    .reset-card {
        max-width: 400px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 32px 28px 24px 28px;
    }
    .reset-card h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 24px;
    }
    .reset-card label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    .reset-card input[type="password"] {
        width: 100%;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        margin-bottom: 18px;
        font-size: 1rem;
        background: #f9fafb;
    }
    .reset-card .btn-row {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 10px;
    }
    .reset-card .btn-warning {
        background: #1677ff;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: 600;
        box-shadow: 0 1px 4px rgba(22,119,255,0.08);
        transition: background 0.2s;
    }
    .reset-card .btn-warning:hover {
        background: #0056b3;
    }
    .reset-card .btn-secondary {
        background: #6c757d;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: 600;
        box-shadow: 0 1px 4px rgba(108,117,125,0.08);
        transition: background 0.2s;
    }
    .reset-card .btn-secondary:hover {
        background: #495057;
    }
</style>

<!-- MANAJEMEN ROLE -->
  <!-- create -->
 <style>
    .role-card {
        max-width: 480px;
        margin: 40px auto;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 32px 28px 24px 28px;
    }
    .role-card h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 24px;
    }
    .role-card label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    .role-card select,
    .role-card input[type="text"],
    .role-card input[type="password"] {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        margin-bottom: 20px;
        font-size: 1rem;
        background: #f9fafb;
    }
    .role-card .form-check {
        margin-bottom: 18px;
    }
    .role-card .btn-row {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 10px;
    }
    .role-card .btn-primary {
        background: #1677ff;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: 600;
        box-shadow: 0 1px 4px rgba(22,119,255,0.08);
        transition: background 0.2s;
    }
    .role-card .btn-primary:hover {
        background: #0056b3;
    }
    .role-card .btn-secondary {
        background: #6c757d;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: 600;
        box-shadow: 0 1px 4px rgba(108,117,125,0.08);
        transition: background 0.2s;
    }
    .role-card .btn-secondary:hover {
        background: #495057;
    }
</style>


<!-- JENIS HEWAN -->
  <!-- create -->
   <!-- UPDATE -->
    <!-- DELETE -->

