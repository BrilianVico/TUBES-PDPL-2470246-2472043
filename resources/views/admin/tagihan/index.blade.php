<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tagihan - SMP Sunodia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f5f9;
            color: #112250;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #112250, #08122d);
            color: white;
            padding: 35px 24px;
            box-shadow: 5px 0 35px rgba(17, 34, 80, 0.15);
            border-right: 1px solid rgba(224, 181, 143, 0.1);
            z-index: 100;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
            font-weight: 700;
        }

        .menu a, .menu button {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(245, 240, 233, 0.75);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 14px;
            font-weight: 500;
            border: 1px solid transparent;
            width: 100%;
            background: transparent;
            cursor: pointer;
        }

        .menu a:hover, .menu a.active, .menu button:hover, .menu button.active {
            background: rgba(224, 181, 143, 0.12) !important;
            color: #E0C58F !important;
            border-color: rgba(224, 181, 143, 0.25);
            transform: translateX(4px);
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .topbar {
            background: linear-gradient(135deg,#3C507D,#112250);
            border-radius: 24px;
            padding: 30px 36px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .topbar h1 {
            font-size: 44px;
            font-weight: 800;
            margin-bottom: 6px;
            color: white;
        }

        .topbar p {
            margin: 0;
            color: rgba(255,255,255,.85);
            font-size: 16px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #3C507D, #1B316D);
            color: white;
            padding: 12px 22px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(23, 109, 76, 0.25);
            transition: all 0.25s ease;
        }

        .btn-primary-custom:hover {
            color: white;
            background: linear-gradient(135deg, #1B316D, #0b3a25);
            box-shadow: 0 8px 25px rgba(23, 109, 76, 0.35);
            transform: translateY(-1px);
        }

        .card-box {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px -5px rgba(17, 34, 80, 0.05), 0 5px 15px -5px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(217, 203, 194, 0.45);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .table thead th {
            color: #3C507D;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(217, 203, 194, 0.5);
            padding: 16px 12px;
        }

        .table tbody td {
            padding: 16px 12px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(217, 203, 194, 0.25);
            color: #112250;
        }

        .table tbody tr:hover {
            background: #F5F0E9;
        }

        .badge-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-lunas {
            background: #dcfce7;
            color: #166534;
        }

        .badge-belum {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-edit {
            background: #facc15;
            color: #713f12;
            border: none;
        }

        .btn-edit:hover {
            background: #eab308;
            color: #713f12;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
        }

        .btn-sm {
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .alert {
            border: none;
            border-radius: 14px;
            padding: 14px 18px;
        }

        .empty-state {
            text-align: center;
            padding: 50px 0;
            color: #94a3b8;
        }

        .badge-locked {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
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

<div class="sidebar">
    <div style="text-align:center;margin-bottom:35px;">
        <img src="{{ asset('IMG/ImageLogo.png') }}" style="width: 95px;margin-bottom:10px;">
        <h2 style="margin:0;font-size:22px;">Sunodia</h2>
        <p style="font-size:12px;opacity:.8;margin-top:5px;">Portal Admin</p>
    </div>

    <div class="menu">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.data-siswa') }}" class="{{ request()->routeIs('admin.data-siswa.*') ? 'active' : '' }}">Data Siswa</a>
        <a href="{{ route('admin.tagihan.index') }}" class="{{ request()->routeIs('admin.tagihan.*') ? 'active' : '' }}">Tagihan</a>
        <a href="{{ route('admin.pembayaran.index') }}" class="{{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">Pembayaran</a>
        <a href="{{ route('admin.beasiswa.index') }}" class="{{ request()->routeIs('admin.beasiswa.*') ? 'active' : '' }}">Beasiswa</a>
        <a href="{{ route('admin.pengumuman.index') }}" class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">Pengumuman</a>
        <a href="{{ route('admin.pengajuan.index') }}" class="{{ request()->routeIs('admin.pengajuan.*') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <span>Pengajuan Beasiswa</span>
            @if(isset($notifBeasiswaAdmin) && $notifBeasiswaAdmin > 0)
                <span style="background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifBeasiswaAdmin }}</span>
            @endif
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="width:100%; padding:14px 18px; border:none; border-radius:14px; background:rgba(239,68,68,.15); color:#fecaca; font-weight:600; cursor:pointer;">
                Logout
            </button>
        </form>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <div>
            <h1>Data Tagihan</h1>
            <p>Kelola seluruh tagihan siswa SMP Sunodia</p>
        </div>

        <a href="{{ route('admin.tagihan.create') }}" class="btn-primary-custom">
            + Tambah Tagihan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="card-box">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.tagihan.index') }}" class="row g-3 mb-4 p-3 bg-light rounded align-items-end" style="border: 1px solid rgba(17, 34, 80, 0.1);">
            <div class="col-md-4">
                <label for="filter_bulan" class="form-label" style="font-weight: 600; font-size: 13px; color: #112250;">Filter Bulan</label>
                <select name="bulan" id="filter_bulan" class="form-select" style="border-radius: 8px;">
                    <option value="">-- Semua Bulan --</option>
                    @foreach($availableMonths as $m)
                        @php
                            $bulanNama = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                            $namaBulan = $bulanNama[(int)$m] ?? 'Bulan ' . $m;
                        @endphp
                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>{{ $namaBulan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="filter_tahun" class="form-label" style="font-weight: 600; font-size: 13px; color: #112250;">Filter Tahun</label>
                <select name="tahun" id="filter_tahun" class="form-select" style="border-radius: 8px;">
                    <option value="">-- Semua Tahun --</option>
                    @foreach($availableYears as $y)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary" style="background-color: #112250; border-color: #112250; border-radius: 8px; font-weight: 600; padding: 8px 20px;">
                    Filter
                </button>
                @if(request('bulan') || request('tahun'))
                    <a href="{{ route('admin.tagihan.index') }}" class="btn btn-secondary" style="border-radius: 8px; font-weight: 600; padding: 8px 20px;">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Tagihan</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th>Potongan</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $namaBulan = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                @endphp

                @forelse($tagihan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_tagihan }}</td>
                        <td>
                            {{ $namaBulan[$item->bulan] ?? $item->bulan }}
                        </td>
                        <td>{{ $item->tahun }}</td>
                        <td>
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td>
                            Rp {{ number_format($item->potongan_beasiswa ?? 0, 0, ',', '.') }}
                        </td>
                        <td>
                            Rp {{ number_format($item->nominal - ($item->potongan_beasiswa ?? 0), 0, ',', '.') }}
                        </td>
                        <td>
                            @if(strtoupper($item->status) == 'LUNAS')
                                <span class="badge-status badge-lunas">Lunas</span>
                            @else
                                <span class="badge-status badge-belum">Belum Lunas</span>
                            @endif
                        </td>
                        <td>
                            {{-- PENGECEKAN UTAMA STATUS LUNAS --}}
                            @if(strtoupper($item->status) != 'LUNAS')
                                <a href="{{ route('admin.tagihan.edit', $item->id_tagihan) }}" class="btn btn-sm btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('admin.tagihan.destroy', $item->id_tagihan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-success badge-locked">
                                    Terkunci
                                </span>
                            @endif
                            {{-- Perbaikan: Form duplikat di bawah baris ini sudah dihapus sepenuhnya --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">
                            <div class="empty-state">
                                Belum ada data tagihan.
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
