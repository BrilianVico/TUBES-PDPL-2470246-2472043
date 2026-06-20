<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMP Sunodia</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #3C507D;
            --primary-dark: #112250;
            --primary-light: #5a6e9c;
            --bg: #F5F0E9;
            --card: #ffffff;
            --text: #112250;
            --muted: #5a6e9c;
            --accent: #E0C58F;
            --danger: #ef4444;
            --success: #22c55e;
            --shadow-sm: 0 4px 6px rgba(17, 34, 80, 0.03);
            --shadow-md: 0 10px 25px rgba(17, 34, 80, 0.05);
            --shadow-lg: 0 20px 40px rgba(17, 34, 80, 0.08);
            --radius-sm: 12px;
            --radius-md: 20px;
            --radius-lg: 28px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* Main Content */
        .content {
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Topbar Header */
        .topbar {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            padding: 24px 35px;
            border-radius: var(--radius-md);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar h1 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .topbar p {
            color: var(--muted);
            font-size: 14px;
            margin-top: 4px;
            font-weight: 500;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: white;
            border-radius: 50px;
            border: 1px solid rgba(17, 34, 80, 0.08);
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* Cards Grid */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }

        .card {
            background: var(--card);
            border-radius: var(--radius-md);
            padding: 28px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(224, 181, 143, 0.15);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 150px;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
            border-radius: 4px 0 0 4px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(224, 181, 143, 0.5);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .card h3 {
            font-size: 14px;
            color: var(--muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(60, 80, 125, 0.08);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: 0.3s;
        }

        .card:hover .card-icon {
            background: var(--primary-dark);
            color: var(--accent);
            transform: rotate(8deg);
        }

        .card .value {
            font-size: 38px;
            font-weight: 800;
            color: var(--primary-dark);
            margin-top: 15px;
        }

        /* Welcome Box */
        .welcome-box {
            background: linear-gradient(135deg, #112250, #08122d);
            color: white;
            padding: 40px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(224, 181, 143, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .welcome-box::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(224, 181, 143, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
        }

        .welcome-box h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 12px;
            color: var(--accent);
        }

        .welcome-box p {
            line-height: 1.8;
            opacity: 0.85;
            font-size: 15px;
            max-width: 700px;
        }

        /* Premium Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>
</head>
<body>

{{-- Sidebar --}}
@include('layouts.admin_sidebar')

{{-- Main Content --}}
<div class="content">

    {{-- Topbar --}}
    <div class="topbar">
        <div>
            <h1>Dashboard Administrasi</h1>
            <p>{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="admin-profile">
            <div class="admin-avatar">A</div>
            <div style="font-size: 13px; font-weight: 600;">Administrator</div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="cards">
        <div class="card" style="border-left: none;">
            <div class="card-header">
                <h3>Total Siswa</h3>
                <div class="card-icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="value">{{ $totalSiswa }}</div>
        </div>

        <div class="card" style="border-left: none;">
            <div class="card-header">
                <h3>Total Tagihan</h3>
                <div class="card-icon"><i class="fas fa-receipt"></i></div>
            </div>
            <div class="value">{{ $totalTagihan }}</div>
        </div>

        <div class="card" style="border-left: none;">
            <div class="card-header">
                <h3>Pembayaran Baru</h3>
                <div class="card-icon"><i class="fas fa-wallet"></i></div>
            </div>
            <div class="value">{{ $pembayaranHariIni }}</div>
        </div>

        <div class="card" style="border-left: none;">
            <div class="card-header">
                <h3>Pengajuan Beasiswa</h3>
                <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
            </div>
            <div class="value">{{ $pengajuanBeasiswa }}</div>
        </div>
    </div>

    {{-- Welcome Box --}}
    <div class="welcome-box">
        <h2>Selamat Datang di Sistem Administrasi Sekolah</h2>
        <p>
            Gunakan dashboard ini untuk mengelola data siswa, tagihan,
            pembayaran, beasiswa, dan pengumuman SMP Sunodia secara efisien. Pantau seluruh alur keuangan sekolah dan data pengajuan beasiswa siswa secara terpusat.
        </p>
    </div>

</div>

</body>
</html>

