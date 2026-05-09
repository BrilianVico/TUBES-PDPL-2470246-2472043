<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAP Sekolah SMP Sunodia</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            padding: 20px;
            background: url("{{ asset('IMG/GambarSekolah.png') }}") no-repeat center center fixed;
            background-size: cover;
            position: relative;
            color: #fff;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at top right, rgba(59,130,246,0.15), transparent 40%),
                radial-gradient(circle at bottom left, rgba(16,185,129,0.12), transparent 40%),
                rgba(2, 6, 23, 0.72);
            backdrop-filter: blur(8px);
            z-index: -1;
        }

        .logo {
            position: fixed;
            top: 25px;
            right: 30px;
        }

        .logo img {
            width: 85px;
        }

        .card {
            width: 100%;
            max-width: 760px;
            padding: 55px 60px;
            border-radius: 30px;
            background: linear-gradient(
                135deg,
                rgba(15, 23, 42, 0.92),
                rgba(30, 41, 59, 0.88)
            );
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 30px 80px rgba(0,0,0,0.45);
            backdrop-filter: blur(18px);
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 999px;
            background: rgba(16,185,129,0.12);
            border: 1px solid rgba(16,185,129,0.35);
            color: #a7f3d0;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 18px;
            background: linear-gradient(90deg, #ffffff, #bfdbfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .description {
            max-width: 620px;
            margin: 0 auto 36px;
            line-height: 1.9;
            font-size: 1.05rem;
            color: rgba(255,255,255,0.82);
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 36px;
        }

        .btn {
            min-width: 170px;
            padding: 14px 28px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-login {
            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 12px 24px rgba(16,185,129,0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 12px 24px rgba(59,130,246,0.25);
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.02);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }

        .feature {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 18px;
            padding: 20px 16px;
        }

        .feature .icon {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .feature h3 {
            font-size: 0.95rem;
            margin-bottom: 6px;
        }

        .feature p {
            font-size: 0.8rem;
            line-height: 1.6;
            color: rgba(255,255,255,0.7);
        }

        .footer {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.6);
        }

        @media (max-width: 768px) {
            .card {
                padding: 38px 24px;
            }

            h1 {
                font-size: 2.2rem;
            }

            .description {
                font-size: 0.95rem;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .btn {
                width: 100%;
                min-width: unset;
            }

            .logo img {
                width: 65px;
            }
        }
    </style>
</head>
<body>

<div class="logo">
    <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo SMP Sunodia">
</div>

<div class="card">
    <div class="badge">Sistem Informasi Administrasi & Pembayaran</div>

    <h1>SIAP Sekolah<br>SMP Sunodia</h1>

    <p class="description">
        Kelola administrasi sekolah, tagihan, dan pembayaran siswa
        secara online dengan sistem yang aman, modern, dan mudah digunakan.
    </p>

    <div class="buttons">
        <a href="{{ route('login.menu') }}" class="btn btn-login">🔐 Login</a>
        <a href="{{ route('register.sekolah') }}" class="btn btn-register">📝 Register</a>
    </div>

    <div class="features">
        <div class="feature">
            <div class="icon">💳</div>
            <h3>Pembayaran Online</h3>
            <p>Pantau tagihan dan riwayat pembayaran siswa.</p>
        </div>

        <div class="feature">
            <div class="icon">🎓</div>
            <h3>Data Akademik</h3>
            <p>Terintegrasi dengan data administrasi sekolah.</p>
        </div>

        <div class="feature">
            <div class="icon">🔒</div>
            <h3>Aman & Terverifikasi</h3>
            <p>Akun disetujui terlebih dahulu oleh admin.</p>
        </div>
    </div>

    <div class="footer">
        © {{ date('Y') }} SMP Sunodia • Kalimantan Timur
    </div>
</div>

</body>
</html>
