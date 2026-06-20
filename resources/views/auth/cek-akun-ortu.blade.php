{{-- resources/views/auth/cek_akun.blade.php --}}
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Informasi Akun - SMP Sunodia</title>

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
            --bg: #F5F0E9; /* Swan Wing */
            --card: #ffffff;
            --text: #112250;
            --muted: #5a6e9c;
            --accent: #E0C58F; /* Quicksand */
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
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at top right, rgba(16, 185, 129, 0.18), transparent 35%),
                radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.12), transparent 35%),
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
            filter: drop-shadow(0 10px 20px rgba(0,0,0,.25));
        }

        .wrapper {
            width: 100%;
            max-width: 500px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95) !important;
            border-radius: var(--radius);
            padding: 40px 35px;
            box-shadow: 0 30px 60px rgba(8, 18, 45, 0.25) !important;
            border: 1px solid rgba(224, 181, 143, 0.3) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: var(--accent) !important;
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
            font-size: 2.1rem;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .description {
            font-size: 0.92rem;
            line-height: 1.6;
            color: var(--muted);
            margin-bottom: 28px;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            line-height: 1.7;
            text-align: left;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #ef4444;
        }

        /* Result Box styling matched with premium system */
        .result-box {
            padding: 20px;
            border-radius: 16px;
            background: rgba(34, 197, 94, 0.06);
            border: 1px solid rgba(34, 197, 94, 0.25);
            margin-bottom: 24px;
            text-align: left;
        }

        .result-box h3 {
            font-size: 1.05rem;
            margin-bottom: 12px;
            color: #16a34a;
            font-weight: 700;
        }

        .result-item {
            margin-bottom: 8px;
            font-size: 0.95rem;
            color: var(--primary-dark);
        }

        .result-item strong {
            color: var(--muted);
            font-weight: 500;
            display: inline-block;
            width: 140px;
        }

        .info-text {
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px dashed rgba(34, 197, 94, 0.2);
            font-size: 0.84rem;
            line-height: 1.6;
            color: var(--muted);
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .form-control {
            width: 100%;
            font-family: 'Poppins', sans-serif;
            border: 1.5px solid rgba(60, 80, 125, 0.2) !important;
            border-radius: 12px !important;
            padding: 12px 16px !important;
            background-color: #ffffff !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            color: var(--primary-dark) !important;
            font-size: 0.95rem;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 4px rgba(224, 181, 143, 0.25) !important;
        }

        .btn-submit {
            width: 100%;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #3C507D, #112250) !important;
            color: #ffffff !important;
            border: 1px solid rgba(224, 181, 143, 0.3) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            padding: 14px !important;
            box-shadow: 0 4px 15px rgba(17, 34, 80, 0.15) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            cursor: pointer !important;
            font-size: 0.95rem;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #112250, #08122d) !important;
            transform: translateY(-2px) scale(1.01) !important;
            box-shadow: 0 6px 20px rgba(17, 34, 80, 0.25) !important;
            color: var(--accent) !important;
        }

        .back-link {
            display: inline-block;
            margin-top: 24px;
            color: var(--muted) !important;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--primary-dark) !important;
            text-decoration: underline;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.8rem;
            color: var(--muted);
            border-top: 1px solid rgba(60, 80, 125, 0.1);
            padding-top: 20px;
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 20px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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

        <div class="badge">Cek Akun</div>

        <h1>Informasi Akun Orang Tua</h1>

        <p class="description">
            Masukkan nama lengkap wali dan nama lengkap anak untuk melihat username yang terdaftar di sistem.
        </p>

        @if(session('error'))
            <div class="alert alert-danger">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        @if(session('data_akun'))
            <div class="result-box">
                <h3>✓ Akun Ditemukan</h3>

                <div class="result-item">
                    <strong>Username (NIK)</strong>: {{ session('data_akun')->nik }}
                </div>

                <div class="result-item">
                    <strong>NIS Anak</strong>: {{ session('data_akun')->nis }}
                </div>

                <div class="info-text">
                    Jika Anda belum pernah mengganti password, gunakan <strong>NIS anak pertama</strong> sebagai password login bawaan sistem.
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('ortu.cek-akun.process') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Lengkap Wali</label>
                <input
                    type="text"
                    name="nama_wali"
                    class="form-control"
                    value="{{ old('nama_wali') }}"
                    placeholder="Masukkan nama lengkap wali"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label">Nama Lengkap Anak</label>
                <input
                    type="text"
                    name="nama_anak"
                    class="form-control"
                    value="{{ old('nama_anak') }}"
                    placeholder="Masukkan nama lengkap anak"
                    required
                >
            </div>

            <button type="submit" class="btn-submit">
                Tampilkan Informasi Akun
            </button>
        </form>

        <a href="{{ route('login.ortu') }}" class="back-link">
            ← Kembali ke Login Orang Tua
        </a>

        <div class="footer">
            © {{ date('Y') }} Sistem Pembayaran Sekolah SMP Sunodia
        </div>

    </div>
</div>

</body>
</html>
