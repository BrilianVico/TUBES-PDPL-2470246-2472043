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

        :root {
            --primary: #3C507D; /* Sapphire */
            --primary-dark: #112250; /* Royal Blue */
            --primary-light: #5a6e9c;
            --bg: #F5F0E9; /* Swan Wing */
            --card: #ffffff;
            --text: #112250; /* Royal Blue text */
            --muted: #5a6e9c;
            --accent: #E0C58F; /* Quicksand */
            --accent-dark: #d9cbc2; /* Shellstone */
            --shadow: 0 20px 40px rgba(17, 34, 80, 0.08);
            --radius: 24px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background: url('{{ asset('IMG/GambarSekolah.png') }}') center center / cover no-repeat fixed;
            color: var(--text);
            position: relative;
            overflow-x: hidden;
        }

        /* Overlay premium agar background selaras dengan tema dark-blue & warm blend */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at top right, rgba(60, 80, 125, 0.3), transparent 40%),
                radial-gradient(circle at bottom left, rgba(17, 34, 80, 0.4), transparent 40%),
                rgba(8, 18, 45, 0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
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
            filter: drop-shadow(0 10px 20px rgba(0,0,0,.25));
        }

        .wrapper {
            width: 100%;
            max-width: 720px;
            text-align: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.95) !important;
            border-radius: var(--radius);
            padding: 45px 35px;
            box-shadow: 0 30px 60px rgba(8, 18, 45, 0.25) !important;
            border: 1px solid rgba(224, 181, 143, 0.3) !important;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: var(--accent) !important;
            box-shadow: 0 35px 70px rgba(8, 18, 45, 0.35) !important;
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 30px;
            background: rgba(60, 80, 125, 0.08);
            border: 1px solid rgba(60, 80, 125, 0.15);
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 20px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        h1 {
            font-size: 2.4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .description {
            max-width: 600px;
            margin: 0 auto 36px;
            line-height: 1.7;
            font-size: 0.95rem;
            color: var(--muted);
        }

        .role-box {
            background: var(--bg);
            border: 1px solid rgba(60, 80, 125, 0.1);
            border-radius: 20px;
            padding: 26px;
            margin-bottom: 15px;
        }

        .role-box h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--primary-dark);
            text-align: left;
            padding-left: 4px;
        }

        .roles {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .role {
            flex: 1;
            min-width: 240px;
            padding: 30px 22px;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid rgba(60, 80, 125, 0.12);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            box-shadow: 0 4px 12px rgba(17, 34, 80, 0.02);
        }

        .role:hover {
            transform: translateY(-5px) scale(1.02);
            border-color: var(--accent);
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 15px 30px rgba(17, 34, 80, 0.1);
        }

        .role:hover .role-title {
            color: var(--primary);
        }

        .icon {
            font-size: 2.6rem;
            margin-bottom: 14px;
            display: block;
        }

        .role-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-dark);
            transition: color 0.3s ease;
        }

        .role-desc {
            font-size: 0.85rem;
            line-height: 1.6;
            color: var(--muted);
        }

        .footer {
            margin-top: 35px;
            font-size: 0.8rem;
            line-height: 1.8;
            color: var(--muted);
            border-top: 1px solid rgba(60, 80, 125, 0.1);
            padding-top: 20px;
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .footer a:hover {
            text-decoration: underline;
            color: var(--primary-dark);
        }

        /* Modern Page Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Premium Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F5F0E9;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            body {
                padding: 16px;
            }

            .card {
                padding: 30px 20px;
            }

            h1 {
                font-size: 1.85rem;
            }

            .role {
                width: 100%;
                flex: none;
            }

            .logo-top {
                position: absolute;
                top: 16px;
                right: 16px;
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
                    <span class="icon">👪</span>
                    <div class="role-title">Orang Tua</div>
                    <div class="role-desc">
                        Melihat tagihan, status pembayaran, dan informasi administrasi siswa.
                    </div>
                </div>

                <div class="role" onclick="window.location.href='{{ route('login') }}'">
                    <span class="icon">🔒</span>
                    <div class="role-title">Admin</div>
                    <div class="role-desc">
                        Mengelola data siswa, tagihan, pembayaran, dan laporan keuangan.
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            © {{ date('Y') }} Sistem Pembayaran Sekolah SMP Sunodia<br>
            Bantuan & Kontak IT Support:<br>
            <a href="mailto:2472046@maranatha.ac.id">2472046@maranatha.ac.id</a> |
            <a href="mailto:2472043@maranatha.ac.id">2472043@maranatha.ac.id</a>
        </div>
    </div>
</div>

</body>
</html>
