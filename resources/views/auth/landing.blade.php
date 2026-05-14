<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pembayaran Sekolah SMP Sunodia</title>

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
            color: #fff;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.75);
            backdrop-filter: blur(8px);
            z-index: -1;
        }

        .card {
            width: 100%;
            max-width: 700px;
            padding: 50px;
            border-radius: 30px;
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 30px 80px rgba(0,0,0,0.45);
            text-align: center;
        }

        .logo {
            width: 90px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
        }

        p {
            color: rgba(255,255,255,0.75);
            line-height: 1.8;
            margin-bottom: 35px;
        }

        .buttons {
            display: grid;
            gap: 15px;
        }

        .btn {
            display: block;
            padding: 15px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .btn-secondary {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: #e2e8f0;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .footer {
            margin-top: 30px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.55);
        }
    </style>
</head>
<body>

<div class="card">
    <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo Sunodia" class="logo">

    <h1>Sistem Pembayaran Sekolah</h1>

    <p>
        Selamat datang di Sistem Pembayaran Sekolah SMP Sunodia.
        Silakan pilih menu di bawah ini untuk melanjutkan.
    </p>

    <div class="buttons">
        <a href="{{ route('login.menu') }}" class="btn btn-primary">
            🔐 Masuk ke Sistem
        </a>

        <a href="{{ route('register.sekolah') }}" class="btn btn-secondary">
            🏫 Registrasi Sekolah
        </a>
    </div>

    <div class="footer">
        © {{ date('Y') }} Sistem Pembayaran Sekolah SMP Sunodia
    </div>
</div>

</body>
</html>
