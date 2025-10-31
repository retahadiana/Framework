<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — RSHP UNAIR</title>

    <!-- Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --blue:#006a94;
            --light-blue:#00b4d8;
            --bg:#f1f5f9;
            --card:#ffffff;
            --shadow:0 15px 35px rgba(0,0,0,0.08);
        }
        * { box-sizing:border-box; margin:0; padding:0; }
        body {
            font-family:'Poppins',sans-serif;
            background:linear-gradient(135deg, var(--light-blue), var(--blue));
            display:flex; justify-content:center; align-items:center;
            min-height:100vh;
        }

        .login-container {
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            background:var(--card);
            border-radius:16px;
            box-shadow:var(--shadow);
            overflow:hidden;
            max-width:440px;
            width:100%;
            padding:40px 45px;
            animation:fadeIn 0.7s ease-out;
        }

        .brand {
            text-align:center;
            margin-bottom:24px;
        }
        .brand h1 {
            font-size:22px;
            font-weight:700;
            color:var(--blue);
            line-height:1.4;
        }
        .brand p {
            font-size:14px;
            color:#64748b;
            margin-top:6px;
        }

        form {
            width:100%;
            display:flex;
            flex-direction:column;
            gap:14px;
        }
        label {
            font-size:14px;
            font-weight:600;
            color:#475569;
        }
        input[type=email], input[type=password] {
            width:100%;
            padding:12px 14px;
            border-radius:10px;
            border:1px solid #d0d7e2;
            font-size:15px;
            transition:0.2s;
        }
        input:focus {
            outline:none;
            border-color:var(--light-blue);
            box-shadow:0 0 0 3px rgba(0,180,216,0.2);
        }
        .actions {
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-size:13px;
        }
        .btn {
            background:var(--blue);
            color:#fff;
            padding:12px 16px;
            border:none;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
            transition:background 0.25s;
        }
        .btn:hover { background:#004c68; }
        .btn-secondary {
            background:#fff;
            color:var(--blue);
            border:1px solid var(--blue);
            display:block;
            text-align:center;
            margin-top:8px;
        }
        .oauth {
            display:flex;
            justify-content:center;
            gap:10px;
            margin-top:16px;
        }
        .oauth a {
            text-decoration:none;
            border:1px solid #e2e8f0;
            padding:8px 14px;
            border-radius:8px;
            display:flex;
            align-items:center;
            gap:8px;
            color:#475569;
            font-weight:600;
            transition:all 0.2s;
        }
        .oauth a:hover {
            background:#f8fafc;
            border-color:#cbd5e1;
        }

        .small {
            font-size:13px;
            color:#64748b;
            text-align:center;
            margin-top:20px;
        }

        .error {
            background:#fff6f6;
            border:1px solid #ffb4b4;
            padding:10px 14px;
            border-radius:8px;
            color:#b91c1c;
            margin-bottom:10px;
            font-size:14px;
        }

        @keyframes fadeIn {
            from { opacity:0; transform:translateY(10px); }
            to { opacity:1; transform:translateY(0); }
        }

        @media(max-width:480px) {
            .login-container { padding:30px 24px; }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="brand">
            <h1>Rumah Sakit Hewan Pendidikan<br>Universitas Airlangga</h1>
            <p>Sistem Informasi Pelayanan & Manajemen RSHP</p>
        </div>

        @if($errors->any())
            <div class="error">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin-top:6px; margin-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="nama@domain.com" autofocus>
            </div>
            <div>
                <label for="password">Kata Sandi</label>
                <input id="password" type="password" name="password" required placeholder="••••••••">
            </div>

            <div class="actions">
                <label><input type="checkbox" name="remember"> Ingat saya</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
                @endif
            </div>

            <button type="submit" class="btn">Masuk</button>
            <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Akun Baru</a>

            <div class="oauth">
                <a href="#"><i class="fab fa-google" style="color:#db4437"></i> Google</a>
                <a href="#"><i class="fab fa-github"></i> GitHub</a>
            </div>
        </form>

        <p class="small">© {{ date('Y') }} RSHP Universitas Airlangga. Semua hak dilindungi.</p>
    </div>
</body>
</html>
