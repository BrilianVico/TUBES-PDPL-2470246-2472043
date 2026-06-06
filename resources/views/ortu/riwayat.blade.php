<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran | Sunodia Academy</title>

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

        /* Menu */
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

        /* Main Content */
        .main {
            flex: 1;
            margin-left: 280px;
            min-height: 100vh;
            padding: 40px;
        }

        .content-wrapper {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
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
        .table-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 35px;
            width: 100%;
            box-shadow: var(--shadow);
        }

        /* Custom Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            color: var(--primary);
            border-bottom: 2px solid #f1f5f9;
            padding: 16px 12px;
        }

        .table td {
            padding: 16px 12px;
            vertical-align: middle;
            color: #334155;
        }

        /* Custom Badges */
        .badge-success {
            background-color: rgba(22, 163, 74, 0.1);
            color: #16a34a;
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
        }

        .badge-warning {
            background-color: rgba(217, 119, 6, 0.1);
            color: #d97706;
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
        }

        .btn-detail {
            background-color: #f1f5f9;
            color: var(--text);
            border: none;
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-detail:hover {
            background-color: #e2e8f0;
            color: var(--text);
        }

        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .table-card {
                padding: 20px;
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

            <!-- GANTI '#' MENJADI ROUTE DI BAWAH INI -->
            <a href="{{ route('ortu.riwayat.index') }}" class="{{ Request::routeIs('ortu.riwayat.index') ? 'active' : '' }}">
                Riwayat Pembayaran
            </a>

            <a href="{{ route('ortu.beasiswa.create') }}" class="{{ Request::routeIs('ortu.beasiswa.create') ? 'active' : '' }}">
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
                <h1>Riwayat Pembayaran</h1>
                <p>Berikut adalah catatan transaksi pembayaran sekolah yang telah Anda lakukan.</p>
            </div>

            <div class="table-card">

                {{-- Responsif Table Container --}}
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th style="width: 80px;">No</th>
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Pembayaran</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody> @forelse($riwayat as $key => $item) <tr> <td>{{ $key + 1 }}</td> <td> {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') }} </td> <td> {{ $item->nama_siswa }} </td> <td> {{ $item->jenis_tagihan }} <br> <small class="text-muted"> {{ $item->bulan }} {{ $item->tahun }} </small> </td> <td> Rp {{ number_format($item->nominal_bayar,0,',','.') }} </td> <td> @if($item->status_bayar == 'LUNAS') <span class="badge-success"> Lunas </span> @elseif($item->status_bayar == 'DITOLAK') <span class="badge bg-danger"> Ditolak </span> @else <span class="badge-warning"> Menunggu Verifikasi </span> @endif </td> <td> @if($item->bukti_transfer) <a href="{{ asset('storage/bukti-transfer/'.$item->bukti_transfer) }}" target="_blank" class="btn-detail" > Lihat Bukti </a> @else - @endif </td> </tr> @empty <tr> <td colspan="7" class="text-center"> Belum ada riwayat pembayaran. </td> </tr> @endforelse </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>

</div>

</body>
</html>
