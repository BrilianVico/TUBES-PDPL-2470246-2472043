
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Sekolah - SMP Sunodia</title>

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
            filter: drop-shadow(0 10px 20px rgba(0,0,0,.35));
        }

        .wrapper {
            width: 100%;
            max-width: 650px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px -5px rgba(17, 34, 80, 0.05), 0 5px 15px -5px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(217, 203, 194, 0.45);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 999px;
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #a7f3d0;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #ffffff, #d1fae5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .description {
            font-size: 0.95rem;
            line-height: 1.8;
            color: rgba(255,255,255,0.78);
            margin-bottom: 28px;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .full {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            color: rgba(255,255,255,0.9);
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.10);
            background: rgba(255,255,255,0.06);
            color: #ffffff;
            font-size: 0.95rem;
            outline: none;
            transition: 0.3s;
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.45);
        }

        .form-control:focus {
            border-color: #34d399;
            box-shadow: 0 0 0 3px rgba(52,211,153,0.15);
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 12px 24px rgba(16,185,129,0.25);
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }

        .error-box {
            margin-bottom: 20px;
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #fecaca;
            font-size: 0.85rem;
        }

        .success-box {
            margin-bottom: 20px;
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #a7f3d0;
            font-size: 0.85rem;
        }

        .back-button {
            margin-top: 22px;
            text-align: center;
        }

        .back-button a {
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
        }

        .back-button a:hover {
            color: #ffffff;
        }

        .footer {
            margin-top: 24px;
            text-align: center;
            font-size: 0.78rem;
            line-height: 1.8;
            color: rgba(255,255,255,0.55);
        }

        @media (max-width: 768px) {
            .row {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: span 1;
            }

            .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px -5px rgba(17, 34, 80, 0.05), 0 5px 15px -5px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(217, 203, 194, 0.45);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

            .logo-top img {
                width: 95px;
            }
        }
    
        .card:hover, .card-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 45px -10px rgba(17, 34, 80, 0.08), 0 10px 20px -5px rgba(0, 0, 0, 0.04);
            border-color: rgba(224, 181, 143, 0.6);
        }

        /* Premium Action Button Styles */
        .btn-primary-custom, .btn-add, .btn-submit, .btn-login, .btn-register, .btn-bayar, .btn-detail, .btn-save, .btn-primary {
            background: linear-gradient(135deg, #3C507D, #112250) !important;
            color: #ffffff !important;
            border: 1px solid rgba(224, 181, 143, 0.3) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            padding: 10px 20px !important;
            box-shadow: 0 4px 15px rgba(17, 34, 80, 0.15) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            cursor: pointer !important;
        }
        .btn-primary-custom:hover, .btn-add:hover, .btn-submit:hover, .btn-login:hover, .btn-register:hover, .btn-bayar:hover, .btn-detail:hover, .btn-save:hover, .btn-primary:hover {
            background: linear-gradient(135deg, #112250, #08122d) !important;
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 20px rgba(17, 34, 80, 0.25) !important;
            border-color: rgba(224, 181, 143, 0.6) !important;
            color: #E0C58F !important; /* Quicksand color on text hover */
        }
        .btn-primary-custom:active, .btn-add:active, .btn-submit:active, .btn-login:active, .btn-register:active, .btn-bayar:active, .btn-detail:active, .btn-save:active, .btn-primary:active {
            transform: translateY(0) scale(0.98) !important;
        }

        /* Success & Other Accent Buttons */
        .btn-success, .btn-edit, .btn-edit-custom {
            background: #E0C58F !important; /* Quicksand */
            color: #112250 !important; /* Royal Blue text */
            border: 1px solid rgba(17, 34, 80, 0.1) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 4px 12px rgba(224, 181, 143, 0.2) !important;
        }
        .btn-success:hover, .btn-edit:hover, .btn-edit-custom:hover {
            background: #D9CBC2 !important; /* Shellstone */
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 16px rgba(224, 181, 143, 0.35) !important;
            color: #112250 !important;
        }

        /* Secondary Back Buttons */
        .btn-secondary, .btn-back {
            background: #F5F0E9 !important; /* Swan Wing */
            color: #3C507D !important; /* Sapphire */
            border: 1px solid rgba(60, 80, 125, 0.2) !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .btn-secondary:hover, .btn-back:hover {
            background: #D9CBC2 !important; /* Shellstone */
            transform: translateY(-2px) !important;
            color: #112250 !important;
        }

        /* Danger/Delete Buttons */
        .btn-danger, .btn-delete, .btn-delete-custom {
            background: #ef4444 !important;
            color: white !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 500 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .btn-danger:hover, .btn-delete:hover, .btn-delete-custom:hover {
            background: #dc2626 !important;
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        }

        /* Interactive Form Controls */
        input[type="text"], input[type="password"], input[type="email"], input[type="number"], select, textarea {
            border: 1.5px solid rgba(60, 80, 125, 0.2) !important;
            border-radius: 12px !important;
            padding: 10px 14px !important;
            background-color: #ffffff !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            color: #112250 !important;
        }
        input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus, input[type="number"]:focus, select:focus, textarea:focus {
            outline: none !important;
            border-color: #E0C58F !important; /* Quicksand */
            box-shadow: 0 0 0 4px rgba(224, 181, 143, 0.25) !important;
            background-color: #ffffff !important;
        }

        /* Interactive Tables Hover effect */
        table tbody tr {
            transition: all 0.2s ease !important;
        }
        table tbody tr:hover {
            background-color: rgba(224, 181, 143, 0.04) !important;
            transform: scale(1.002);
        }
    

        /* btn-info specifically for Lihat Bukti */
        .btn-info {
            background: #3C507D !important; /* Sapphire */
            color: #ffffff !important;
            border: 1px solid rgba(224, 181, 143, 0.3) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 4px 12px rgba(60, 80, 125, 0.2) !important;
        }
        .btn-info:hover {
            background: #112250 !important; /* Royal Blue */
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 16px rgba(17, 34, 80, 0.3) !important;
            color: #E0C58F !important; /* Quicksand text color on hover */
        }

        /* Animated Badges */
        .badge-status, .badge-lunas, .badge-success, .badge-warning, .badge-danger, .badge-danger-custom {
            padding: 6px 14px !important;
            border-radius: 30px !important;
            font-weight: 600 !important;
            font-size: 11px !important;
            letter-spacing: 0.05em !important;
            text-transform: uppercase !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .badge-lunas, .badge-success {
            background: rgba(34, 197, 94, 0.1) !important;
            color: #22c55e !important;
            border: 1px solid rgba(34, 197, 94, 0.25) !important;
        }
        .badge-lunas:hover, .badge-success:hover {
            background: rgba(34, 197, 94, 0.2) !important;
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.15) !important;
            transform: scale(1.05);
        }
        .badge-warning {
            background: rgba(245, 158, 11, 0.1) !important;
            color: #f59e0b !important;
            border: 1px solid rgba(245, 158, 11, 0.25) !important;
        }
        .badge-warning:hover {
            background: rgba(245, 158, 11, 0.2) !important;
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.15) !important;
            transform: scale(1.05);
        }
        .badge-danger, .badge-danger-custom {
            background: rgba(239, 68, 68, 0.1) !important;
            color: #ef4444 !important;
            border: 1px solid rgba(239, 68, 68, 0.25) !important;
        }
        .badge-danger:hover, .badge-danger-custom:hover {
            background: rgba(239, 68, 68, 0.2) !important;
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.15) !important;
            transform: scale(1.05);
        }

        /* Modern Page Animations */
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
        .card, .card-box, .welcome-box, .container-box {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        .card:nth-child(1), .card-box:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2), .card-box:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3), .card-box:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4), .card-box:nth-child(4) { animation-delay: 0.4s; }

        /* Premium Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F5F0E9; /* Swan Wing */
        }
        ::-webkit-scrollbar-thumb {
            background: #3C507D; /* Sapphire */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #112250; /* Royal Blue */
        }
    
</style>
</head>
<body>

<div class="logo-top">
    <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo SMP Sunodia">
</div>

<div class="wrapper">
    <div class="card">

        <div class="badge">School Registration</div>

        <h1>Registrasi Akun</h1>

        <p class="description">
            Silakan lengkapi data berikut untuk mendaftarkan akun wali murid
            ke Sistem Pembayaran Sekolah SMP Sunodia.
        </p>

        @if(session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="#">
            @csrf

            <div class="row">
                <div class="form-group full">
                    <label class="form-label">Nama Lengkap Wali</label>
                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor HP</label>
                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="{{ old('no_hp') }}"
                        placeholder="08xxxxxxxxxx"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Siswa</label>
                    <input
                        type="text"
                        name="nama_siswa"
                        class="form-control"
                        value="{{ old('nama_siswa') }}"
                        placeholder="Nama lengkap siswa"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">NIS</label>
                    <input
                        type="text"
                        name="nis"
                        class="form-control"
                        value="{{ old('nis') }}"
                        placeholder="Nomor Induk Siswa"
                        required
                    >
                </div>

                <div class="form-group full">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Buat password akun"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn-register">
                📝 Daftar Sekarang
            </button>
        </form>

        <div class="back-button">
            <a href="{{ route('login.menu') }}">← Kembali ke Menu Utama</a>
        </div>

        <div class="footer">
            © {{ date('Y') }} Sistem Pembayaran Sekolah SMP Sunodia
        </div>

    </div>
</div>

</body>
</html>
