
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Orang Tua - SMP Sunodia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background: url('{{ asset('IMG/GambarSekolah.png') }}') center center / cover no-repeat fixed;
            color: #ffffff;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.75);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: -1;
        }

        .card {
            width: 100%;
            max-width: 520px;
            padding: 40px;
            border-radius: 28px;
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 30px 80px rgba(0,0,0,0.45);
        }

        .badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 999px;
            background: rgba(245, 158, 11, 0.12);
            border: 1px solid rgba(245, 158, 11, 0.35);
            color: #fde68a;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .description {
            color: rgba(255,255,255,0.75);
            line-height: 1.8;
            margin-bottom: 24px;
            font-size: 0.95rem;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 0.85rem;
            line-height: 1.7;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #fecaca;
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #a7f3d0;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(255,255,255,0.92);
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.06);
            color: white;
            outline: none;
            transition: 0.3s;
        }

        input::placeholder {
            color: rgba(255,255,255,0.45);
        }

        input:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 12px 24px rgba(245, 158, 11, 0.25);
            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.85rem;
        }

        .back-link:hover {
            color: white;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="badge">Lupa Password</div>

    <h1>Reset Password Orang Tua</h1>

    <p class="description">
        Masukkan NIK dan nama lengkap anak.
        Password akan di-reset menjadi <strong>NIS anak</strong>.
    </p>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif

    <form method="POST" action="{{ route('ortu.forgot-password.process') }}">
        @csrf

        <div class="form-group">
            <label>NIK / Username</label>
            <input
                type="text"
                name="nik"
                value="{{ old('nik') }}"
                placeholder="Masukkan NIK Anda"
                required
            >
        </div>

        <div class="form-group">
            <label>Nama Lengkap Anak</label>
            <input
                type="text"
                name="nama_anak"
                value="{{ old('nama_anak') }}"
                placeholder="Masukkan nama lengkap anak"
                required
            >
        </div>

        <button type="submit" class="btn">
            🔑 Verifikasi & Reset Password
        </button>
    </form>

    <a href="{{ session('ortu_logged_in') ? route('dashboard.ortu') : route('login.ortu') }}"
       class="back-link">
        ← Kembali
    </a>
</div>

</body>
</html>
