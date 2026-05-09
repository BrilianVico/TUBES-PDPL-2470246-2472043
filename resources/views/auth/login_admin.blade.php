{{-- resources/views/auth/login_admin.blade.php --}}
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMP Sunodia</title>

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
            max-width: 520px;
        }

        .card {
            padding: 38px 40px;
            border-radius: 30px;
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow:
                0 30px 80px rgba(0,0,0,0.45),
                inset 0 1px 0 rgba(255,255,255,0.05);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 999px;
            background: rgba(16,185,129,0.12);
            border: 1px solid rgba(16,185,129,0.35);
            color: #a7f3d0;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #ffffff, #bfdbfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .description {
            font-size: 0.95rem;
            line-height: 1.8;
            color: rgba(255,255,255,0.78);
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
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
            border-color: #6fffd2;
            box-shadow: 0 0 0 3px rgba(111,255,210,0.12);
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.65);
            font-size: 18px;
            cursor: pointer;
            padding: 0;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 0.88rem;
            color: rgba(255,255,255,0.75);
        }

        .remember input {
            accent-color: #10b981;
        }

        .btn-login {
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
        }

        .btn-login:hover {
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
    </style>
</head>
<body>

<div class="logo-top">
    <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo SMP Sunodia">
</div>

<div class="wrapper">
    <div class="card">

        <div class="badge">Administrator Login</div>

        <h1>Login Admin</h1>

        <p class="description">
            Masukkan username dan password untuk mengakses dashboard administrator.
        </p>

        @if(session('error'))
            <div class="error-box">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Username</label>
                <input
                    type="text"
                    name="username"
                    class="form-control"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username admin"
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
                    >
                        👁️
                    </button>
                </div>
            </div>

            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                🔐 Login
            </button>
        </form>

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
        const toggleButton = document.querySelector('.toggle-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = '👁️';
        }
    }
</script>

</body>
</html>
