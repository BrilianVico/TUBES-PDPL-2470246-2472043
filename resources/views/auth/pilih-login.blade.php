{{-- resources/views/auth/pilih-login.blade.php --}}
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Akses Login - SMP Sunodia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            padding: 30px;
            background: url('{{ asset('IMG/GambarSekolah.png') }}') center center / cover no-repeat fixed;
            color: #ffffff;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.18), transparent 35%),
                radial-gradient(circle at bottom left, rgba(16, 185, 129, 0.12), transparent 35%),
                rgba(2, 6, 23, 0.72);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: -1;
        }

        .logo-top {
            position: fixed;
            top: 24px;
            right: 30px;
            z-index: 10;
        }

        .logo-top img {
            width: 90px;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,.35));
        }

        .wrapper {
            width: 100%;
            max-width: 720px;
        }

        .card {
            padding: 32px 40px;
            border-radius: 28px;
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow:
                0 30px 80px rgba(0,0,0,0.45),
                inset 0 1px 0 rgba(255,255,255,0.05);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
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
            margin-bottom: 22px;
        }

        h1 {
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
            background: linear-gradient(90deg, #ffffff, #bfdbfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .description {
            max-width: 650px;
            margin: 0 auto 36px;
            line-height: 1.9;
            font-size: 1rem;
            color: rgba(255,255,255,0.82);
        }

        .role-box {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .role-box h3 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .roles {
            display: flex;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .role {
            width: 220px;
            padding: 30px 20px;
            border-radius: 22px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(111, 255, 210, 0.25);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .role:hover {
            transform: translateY(-6px) scale(1.03);
            border-color: #6fffd2;
            box-shadow: 0 20px 35px rgba(0,0,0,0.25);
        }

        .icon {
            font-size: 3rem;
            margin-bottom: 14px;
        }

        .role-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .role-desc {
            font-size: 0.9rem;
            line-height: 1.7;
            color: rgba(255,255,255,0.72);
        }

        .back-button a {
            display: inline-block;
            padding: 12px 26px;
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .back-button a:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
        }

        .footer {
            margin-top: 28px;
            font-size: 0.82rem;
            line-height: 1.8;
            color: rgba(255,255,255,0.65);
        }

        .footer a {
            color: #6fffd2;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .card {
                padding: 35px 24px;
                border-radius: 24px;
            }

            h1 {
                font-size: 2rem;
            }

            .description {
                font-size: 0.95rem;
            }

            .role {
                width: 100%;
            }

            .logo-top img {
                width: 70px;
            }
        }
    </style>
</head>
<body>

<div class="logo-top">
    <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo SMP Sunodia">
</div>

<div class="wrapper">
    <div class="card">

        <div class="badge">Pilih Jenis Akses</div>

        <h1>Masuk ke Sistem</h1>

        <p class="description">
            Silakan pilih jenis akun yang akan digunakan untuk mengakses
            Sistem Informasi Administrasi dan Pembayaran SMP Sunodia.
        </p>

        <div class="role-box">
            <h3>Masuk sebagai</h3>

            <div class="roles">
                <div class="role" onclick="window.location.href='{{ route('login.ortu') }}'">
                    <div class="icon">👪</div>
                    <div class="role-title">Orang Tua</div>
                    <div class="role-desc">
                        Melihat tagihan, status pembayaran, dan informasi administrasi siswa.
                    </div>
                </div>

                <div class="role" onclick="window.location.href='{{ route('login') }}'">
                    <div class="icon">🔒</div>
                    <div class="role-title">Admin</div>
                    <div class="role-desc">
                        Mengelola data siswa, tagihan, pembayaran, dan laporan.
                    </div>
                </div>
            </div>
        </div>

        <div class="back-button">
            <a href="{{ route('home') }}">← Kembali ke Halaman Utama</a>
        </div>

        <div class="footer">
            © {{ date('Y') }} Sistem Pembayaran Sekolah SMP Sunodia<br>
            Bantuan & Kontak:
            <a href="mailto:2472046@maranatha.ac.id">2472046@maranatha.ac.id</a> |
            <a href="mailto:2472043@maranatha.ac.id">2472043@maranatha.ac.id</a>
        </div>

    </div>
</div>

</body>
</html>
