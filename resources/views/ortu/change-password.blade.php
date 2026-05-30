<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password | Sunodia Academy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #176d4c;
            --primary-dark: #0f5132;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            --radius: 24px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #176d4c, #0f5132);
            color: white;
            padding: 30px 20px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            box-shadow: 10px 0 40px rgba(0, 0, 0, 0.12);
        }

        .brand {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 30px;
        }

        .brand img {
            width: 70px;
            margin-bottom: 10px;
        }

        .brand h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .brand p {
            font-size: 12px;
            opacity: 0.75;
            margin: 0;
        }

        /* Menu polos seperti dashboard */
        .menu a {
            display: block;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-weight: 500;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,0.12);
            color: white;
        }

        .logout-btn {
            margin-top: 30px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 14px;
            background: rgba(239, 68, 68, 0.15);
            color: #fecaca;
            font-weight: 600;
            cursor: pointer;
        }

        /* Main */
        .main {
            flex: 1;
            margin-left: 280px;
            min-height: 100vh;
            padding: 40px;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content-wrapper {
            width: 100%;
            max-width: 760px;
        }

        .topbar {
            margin-bottom: 24px;
        }

        .topbar h1 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .topbar p {
            color: var(--muted);
            margin: 0;
        }

        /* Card */
        .form-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 40px;
            width: 100%;
            box-shadow: var(--shadow);
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(23, 109, 76, 0.15);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .btn-save {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-save:hover {
            background: var(--primary-dark);
            color: white;
        }

        .btn-back {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 20px;
                align-items: flex-start;
            }

            .form-card {
                padding: 25px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="layout">

    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo Sunodia">
            <h2>Sunodia</h2>
            <p>Portal Wali Murid</p>
        </div>

        <nav class="menu">
            <a href="{{ route('dashboard.ortu') }}">
                Dashboard
            </a>

            <a href="{{ route('ortu.tagihan.index') }}">
                Bayar Tagihan
            </a>

            <a href="#">
                Riwayat Pembayaran
            </a>

            <a href="{{ route('ortu.beasiswa.create') }}">
                Daftar Beasiswa
            </a>

            <a href="{{ route('ortu.change-password') }}">
                Ubah Password
            </a>
        </nav>

        <form method="POST" action="{{ route('logout.ortu') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>
    </aside>

    {{-- Main Content --}}
    <main class="main">
        <div class="content-wrapper">
            <div class="topbar">
                <h1>Ubah Password</h1>
                <p>Pastikan password lama Anda benar sebelum mengganti password.</p>
            </div>

            <div class="form-card">

                @if(session('success'))
                    <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ortu.change-password.process') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password"
                               name="password_lama"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password"
                               name="password_baru"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password"
                               name="konfirmasi"
                               class="form-control"
                               required>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('dashboard.ortu') }}"
                           class="btn btn-secondary btn-back">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-save">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

</div>

</body>
</html>
