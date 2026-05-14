{{-- resources/views/dashboard.blade.php --}}
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMP Sunodia</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: white;
            padding: 30px 20px;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
            font-weight: 700;
        }

        .menu a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-size: 15px;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        /* Main Content */
        .content {
            margin-left: 260px;
            padding: 40px;
        }

        /* Topbar */
        .topbar {
            background: white;
            padding: 20px 30px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 28px;
            font-weight: 700;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .card .value {
            font-size: 34px;
            font-weight: bold;
            color: #111827;
        }

        /* Welcome Box */
        .welcome-box {
            margin-top: 30px;
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            color: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.25);
        }

        .welcome-box h2 {
            margin-bottom: 10px;
            font-size: 28px;
        }

        .welcome-box p {
            line-height: 1.7;
            opacity: 0.95;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <h2>SMP Sunodia</h2>

    <div class="menu">
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.data-siswa') }}"
           class="{{ request()->routeIs('admin.data-siswa') ? 'active' : '' }}">
            Data Siswa
        </a>

        <a href="{{ route('admin.tagihan.index') }}"
           class="{{ request()->routeIs('admin.tagihan.*') ? 'active' : '' }}">
            Tagihan
        </a>

        <a href="#">
            Pembayaran
        </a>

        <a href="{{ route('admin.beasiswa.index') }}"
           class="{{ request()->routeIs('admin.beasiswa.*') ? 'active' : '' }}">
            Beasiswa
        </a>

        <a href="#">
            Pengumuman
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="
                        width: 100%;
                        background: transparent;
                        border: none;
                        color: #fca5a5;
                        text-align: left;
                        padding: 14px 18px;
                        border-radius: 12px;
                        cursor: pointer;
                        font-size: 15px;
                        transition: 0.3s;
                    "
                    onmouseover="this.style.background='rgba(255,255,255,0.12)'"
                    onmouseout="this.style.background='transparent'">
                Logout
            </button>
        </form>
    </div>
</div>

{{-- Main Content --}}
<div class="content">

    {{-- Topbar --}}
    <div class="topbar">
        <h1>Dashboard Admin</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    {{-- Statistik --}}
    <div class="cards">
        <div class="card">
            <h3>Total Siswa</h3>
            <div class="value">{{ $totalSiswa }}</div>
        </div>

        <div class="card">
            <h3>Total Tagihan</h3>
            <div class="value">{{ $totalTagihan }}</div>
        </div>

        <div class="card">
            <h3>Pembayaran Hari Ini</h3>
            <div class="value">{{ $pembayaranHariIni }}</div>
        </div>

        <div class="card">
            <h3>Pengajuan Beasiswa</h3>
            <div class="value">{{ $pengajuanBeasiswa }}</div>
        </div>
    </div>

    {{-- Welcome Box --}}
    <div class="welcome-box">
        <h2>Selamat Datang di Sistem Administrasi Sekolah</h2>
        <p>
            Gunakan dashboard ini untuk mengelola data siswa, tagihan,
            pembayaran, beasiswa, dan pengumuman SMP Sunodia.
        </p>
    </div>

</div>

</body>
</html>
