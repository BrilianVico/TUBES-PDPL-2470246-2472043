{{-- resources/views/auth/login_ortu.blade.php --}}
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Orang Tua - SMP Sunodia</title>

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
                radial-gradient(circle at top right, rgba(16, 185, 129, 0.2), transparent 40%),
                radial-gradient(circle at bottom left, rgba(60, 80, 125, 0.35), transparent 40%),
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
            max-width: 480px;
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
            font-size: 2.2rem;
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

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 16px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--muted);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
            font-size: 0.88rem;
            color: var(--muted);
            cursor: pointer;
        }

        .remember input {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .btn-login {
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

        .btn-login:hover {
            background: linear-gradient(135deg, #112250, #08122d) !important;
            transform: translateY(-2px) scale(1.01) !important;
            box-shadow: 0 6px 20px rgba(17, 34, 80, 0.25) !important;
            color: var(--accent) !important;
        }

        .quick-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
        }

        /* Quick links adjustments to match premium system guidelines */
        .quick-link {
            display: block;
            text-align: center;
            padding: 12px 14px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            background: var(--bg) !important;
            color: var(--primary) !important;
            border: 1px solid rgba(60, 80, 125, 0.15) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .quick-link:hover {
            background: var(--accent) !important;
            color: var(--primary-dark) !important;
            border-color: var(--accent) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(224, 181, 143, 0.2) !important;
        }

        .error-box {
            margin-bottom: 20px;
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #ef4444;
            font-size: 0.85rem;
            text-align: left;
        }

        .back-button {
            margin-top: 24px;
            text-align: center;
        }

        .back-button a {
            display: inline-block;
            padding: 8px 20px;
            background: transparent !important;
            color: var(--muted) !important;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-button a:hover {
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
            .quick-links {
                grid-template-columns: 1fr;
            }
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

        <div class="badge">Parent Login</div>

        <h1>Login Orang Tua</h1>

        <p class="description">
            Masukkan username dan password untuk melihat tagihan, riwayat pembayaran, dan informasi administrasi siswa.
        </p>

        @if(session('error'))
            <div class="error-box">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-box">
                ⚠️ {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.ortu.process') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Username (NIK)</label>
                <input
                    type="text"
                    name="username"
                    class="form-control"
                    value="{{ old('username') }}"
                    placeholder="Masukkan NIK Anda"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>

                <div style="position: relative;">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                        style="padding-right: 52px;"
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword()"
                        id="toggleIcon"
                    >

                    </button>
                </div>
            </div>

            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                Login Orang Tua
            </button>
        </form>

        <div class="quick-links">
            <a href="{{ route('ortu.cek-akun') }}" class="quick-link">
                Cek Akun
            </a>

            <a href="{{ route('ortu.forgot-password') }}" class="quick-link">
                Lupa Password
            </a>
        </div>

        <div class="back-button">
            <a href="{{ route('login.menu') }}">← Kembali ke Pilihan Login</a>
        </div>

        <div class="footer">
            © {{ date('Y') }} Sistem Pembayaran Sekolah SMP Sunodia
        </div>

    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';

        } else {
            passwordInput.type = 'password';

        }
    }
</script>

</body>
</html>
