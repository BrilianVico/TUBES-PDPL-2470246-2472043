<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua - SMP Sunodia</title>

    ```
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #176d4c;
            --primary-dark: #0f5132;
            --primary-light: #22c55e;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --danger: #ef4444;
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
        }

        .brand p {
            font-size: 12px;
            opacity: 0.7;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
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

        .main {
            flex: 1;
            margin-left: 280px;
            padding: 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar h1 {
            font-size: 30px;
            font-weight: 800;
        }

        .topbar p {
            color: var(--muted);
            margin-top: 5px;
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 14px;
            background: white;
            padding: 10px 18px;
            border-radius: 50px;
            box-shadow: var(--shadow);
        }

        .avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: linear-gradient(135deg, #176d4c, #22c55e);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
        }

        .profile-box small {
            color: var(--muted);
            display: block;
            font-size: 12px;
        }

        .profile-box strong {
            font-size: 14px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow);
        }

        .stat-label {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .child-item {
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            margin-bottom: 15px;
            background: #f8fafc;
        }

        .child-item h4 {
            font-size: 15px;
            margin-bottom: 4px;
        }

        .child-item p {
            font-size: 13px;
            color: var(--muted);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px 10px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        th {
            color: var(--muted);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background: var(--primary);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
        }
    </style>
    ```

</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo Sunodia">
            <h2>Sunodia</h2>
            <p>Portal Wali Murid</p>
        </div>

        ```
        <nav class="menu">
            <a href="{{ route('dashboard.ortu') }}" class="active">🏠 Dashboard</a>
            <a href="#">💳 Bayar Tagihan</a>
            <a href="#">📄 Riwayat Pembayaran</a>
            <a href="{{ route('ortu.cek-akun') }}">🔍 Cek Akun</a>
            <a href="{{ route('ortu.forgot-password') }}">🔑 Lupa Password</a>
        </nav>

        <form method="POST" action="{{ route('logout.ortu') }}">
            @csrf
            <button type="submit" class="logout-btn">🚪 Logout</button>
        </form>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h1>Halo, {{ session('nama_wali') }}</h1>
                <p>{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>

            <div class="profile-box">
                <div class="avatar">
                    {{ strtoupper(substr(session('nama_wali', 'W'), 0, 1)) }}
                </div>
                <div>
                    <small>Wali Murid</small>
                    <strong>{{ session('username_wali') }}</strong>
                </div>
            </div>
        </div>

        <section class="stats">
            <div class="card">
                <div class="stat-label">Jumlah Anak</div>
                <div class="stat-value">2</div>
            </div>

            <div class="card">
                <div class="stat-label">Tagihan Aktif</div>
                <div class="stat-value" style="color: #ef4444;">3</div>
            </div>

            <div class="card">
                <div class="stat-label">Total Sisa Bayar</div>
                <div class="stat-value" style="font-size: 22px; color: #2563eb;">Rp 1.250.000</div>
            </div>
        </section>

        <section class="content-grid">
            <div class="card">
                <h3 class="section-title">👨‍🎓 Data Anak</h3>

                <div class="child-item">
                    <h4>Brilian Viconaftali</h4>
                    <p>NIS: 24001 • Kelas 9A</p>
                </div>

                <div class="child-item">
                    <h4>Maria Sunodia</h4>
                    <p>NIS: 24002 • Kelas 7B</p>
                </div>
            </div>

            <div class="card">
                <h3 class="section-title">💳 Tagihan Aktif</h3>

                <table>
                    <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Brilian Viconaftali</td>
                        <td>SPP Mei</td>
                        <td>Rp 500.000</td>
                        <td><a href="#" class="btn">Bayar</a></td>
                    </tr>
                    <tr>
                        <td>Maria Sunodia</td>
                        <td>Seragam</td>
                        <td>Rp 750.000</td>
                        <td><a href="#" class="btn">Bayar</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    ```

</div>

</body>
</html>
