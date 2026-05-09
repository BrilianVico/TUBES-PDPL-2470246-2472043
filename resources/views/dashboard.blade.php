{{-- resources/views/dashboard.blade.php --}}
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SMP Sunodia</title>

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
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
        }

        .menu a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,0.12);
            color: #ffffff;
        }

        /* Content */
        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .topbar {
            background: white;
            padding: 20px 30px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 28px;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        }

        .card h3 {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .card .value {
            font-size: 32px;
            font-weight: bold;
            color: #111827;
        }

        .welcome-box {
            margin-top: 30px;
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            color: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.3);
        }

        .welcome-box h2 {
            margin-bottom: 10px;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <h2>🏫 SMP Sunodia</h2>

    <div class="menu">
        <a href="#" class="active">🏠 Dashboard</a>
        <a href="#">👨‍🎓 Data Siswa</a>
        <a href="#">💰 Tagihan</a>
        <a href="#">💳 Pembayaran</a>
        <a href="#">🎓 Beasiswa</a>
        <a href="#">📢 Pengumuman</a>
    </div>
</div>

{{-- Main Content --}}
<div class="content">

    {{-- Topbar --}}
    <div class="topbar">
        <h1>Dashboard Admin</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    {{-- Statistik --}}
    <div class="cards">
        <div class="card">
            <h3>Total Siswa</h3>
            <div class="value">350</div>
        </div>

        <div class="card">
            <h3>Total Tagihan</h3>
            <div class="value">125</div>
        </div>

        <div class="card">
            <h3>Pembayaran Hari Ini</h3>
            <div class="value">18</div>
        </div>

        <div class="card">
            <h3>Pengajuan Beasiswa</h3>
            <div class="value">12</div>
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
