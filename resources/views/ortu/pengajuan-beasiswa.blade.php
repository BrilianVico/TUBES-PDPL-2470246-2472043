<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Beasiswa | Sunodia Academy</title>

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
            --primary: #3C507D;
            --primary-dark: #112250;
            --bg: #F5F0E9;
            --card: #ffffff;
            --text: #112250;
            --muted: #5a6e9c;
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

        .brand {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 30px;
        }

        .brand img {
            width: 95px;
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

        .menu a:hover, .menu a.active {
            background: rgba(224, 181, 143, 0.12) !important;
            color: #E0C58F !important;
            border-color: rgba(224, 181, 143, 0.25);
            transform: translateX(4px);
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
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content-wrapper {
            width: 100%;
            max-width: 1200px;
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

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f1f5f9;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(23, 109, 76, 0.15);
        }

        .form-control[readonly] {
            background-color: #F5F0E9;
            color: var(--muted);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-submit:hover {
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
<script>
    function isiDataSiswa()
    {
        const select = document.getElementById('id_siswa');
        const option = select.options[select.selectedIndex];

        document.getElementById('nis').value = option.dataset.nis || '';
        document.getElementById('nama').value = option.dataset.nama || '';
        document.getElementById('kelas').value = option.dataset.kelas || '';

        document.getElementById('hidden_nis').value = option.dataset.nis || '';
        document.getElementById('hidden_nama').value = option.dataset.nama || '';
        document.getElementById('hidden_kelas').value = option.dataset.kelas || '';

        const warning = document.getElementById('warning-beasiswa-aktif');
        const submitBtn = document.getElementById('btn-submit-beasiswa');
        if (option.dataset.hasActiveBeasiswa === 'true') {
            warning.style.display = 'block';
            if (submitBtn) submitBtn.disabled = true;
        } else {
            warning.style.display = 'none';
            if (submitBtn) submitBtn.disabled = false;
        }
    }
</script>
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
            <a href="{{ route('dashboard.ortu') }}" class="{{ request()->routeIs('dashboard.ortu') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('ortu.tagihan.index') }}" class="{{ request()->routeIs('ortu.tagihan.index') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span>Bayar Tagihan</span>
                <span id="badge-tagihan-ortu" style="{{ isset($notifTagihanOrtu) && $notifTagihanOrtu > 0 ? '' : 'display: none;' }} background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifTagihanOrtu ?? '' }}</span>
            </a>

            <a href="{{ route('ortu.riwayat.index') }}" class="{{ Request::routeIs('ortu.riwayat.index') ? 'active' : '' }}">
                Riwayat Pembayaran
            </a>

            <a href="{{ route('ortu.beasiswa.create') }}" class="active" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span>Daftar Beasiswa</span>
                <span id="badge-beasiswa-ortu" style="{{ isset($notifBeasiswaOrtu) && $notifBeasiswaOrtu > 0 ? '' : 'display: none;' }} background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifBeasiswaOrtu ?? '' }}</span>
            </a>

            <a href="{{ route('ortu.change-password') }}" class="{{ Request::routeIs('ortu.change-password') ? 'active' : '' }}">
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
                <h1>Pengajuan Beasiswa</h1>
                <p>Silakan isi data akademik siswa dengan lengkap. Data akan diverifikasi oleh pihak sekolah.</p>
            </div>

            <div class="row">
                <div class="col-lg-7 mb-4">
                    <div class="form-card">

                        {{-- Alert Sukses Ditambahkan Di Sini --}}
                        @if(session('success'))
                            <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4 fw-bold text-center" style="color: #198754; background-color: #d1e7dd;">
                                PENGAJUAN BERHASIL !
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
                                {{ session('error') }}
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

                        <form method="POST" action="{{ route('ortu.beasiswa.store') }}">
                            @csrf

                            <div class="section-title">Informasi Siswa & Beasiswa</div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label">Pilih Siswa</label>
                                    <select name="id_siswa" id="id_siswa" class="form-select" onchange="isiDataSiswa()" required>
                                        <option value="">Pilih Siswa</option>
                                        @foreach($siswa as $item)
                                            <option value="{{ $item->id_siswa }}"
                                                    data-nis="{{ $item->nis }}"
                                                    data-nama="{{ $item->nama }}"
                                                    data-kelas="{{ $item->kelas }}"
                                                    data-has-active-beasiswa="{{ $item->has_active_beasiswa ? 'true' : 'false' }}">
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div id="warning-beasiswa-aktif" class="alert alert-danger rounded-4 border-0 shadow-sm mt-3" style="display: none;">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Siswa ini sedang menerima beasiswa aktif dalam periode ini dan tidak dapat mendaftar beasiswa lain.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Jenis Beasiswa</label>
                                    <select name="id_beasiswa" class="form-select" required>
                                        <option value="">Pilih Jenis Beasiswa</option>

                                        @foreach($beasiswa as $item)

                                            @if($item->kuota > 0)

                                                <option value="{{ $item->id_beasiswa }}">

                                                    {{ $item->nama_beasiswa }}

                                                    -

                                                    Sisa Slot: {{ $item->sisa_slot }}

                                                    @if($item->jenis_potongan == 'PERSEN')
                                                        ({{ $item->nilai_potongan }}%)
                                                    @else
                                                        (Rp {{ number_format($item->nilai_potongan,0,',','.') }})
                                                    @endif

                                                </option>

                                            @else

                                                <option disabled>

                                                    {{ $item->nama_beasiswa }}

                                                    - SLOT HABIS

                                                </option>

                                            @endif

                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label">NIS</label>
                                    <input type="text" id="nis" class="form-control" readonly>
                                </div>

                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" id="nama" class="form-control" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Kelas</label>
                                    <input type="text" id="kelas" class="form-control" readonly>
                                </div>
                            </div>

                            {{-- Hidden Inputs --}}
                            <input type="hidden" name="nis" id="hidden_nis">
                            <input type="hidden" name="nama" id="hidden_nama">
                            <input type="hidden" name="kelas" id="hidden_kelas">


                            <div class="section-title mt-4">Input Nilai Akademik</div>

                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Bahasa Indonesia</label>
                                    <input type="number" name="nilai_bindo" class="form-control" placeholder="0-100" min="0" max="100" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Bahasa Inggris</label>
                                    <input type="number" name="nilai_bing" class="form-control" placeholder="0-100" min="0" max="100" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Matematika</label>
                                    <input type="number" name="nilai_mtk" class="form-control" placeholder="0-100" min="0" max="100" required>
                                </div>

                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label">PKN</label>
                                    <input type="number" name="nilai_pkn" class="form-control" placeholder="0-100" min="0" max="100" required>
                                </div>

                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label">IPA</label>
                                    <input type="number" name="nilai_ipa" class="form-control" placeholder="0-100" min="0" max="100" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">IPS</label>
                                    <input type="number" name="nilai_ips" class="form-control" placeholder="0-100" min="0" max="100" required>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <a href="{{ route('dashboard.ortu') }}" class="btn btn-secondary btn-back">
                                    Kembali
                                </a>

                                <button type="submit" id="btn-submit-beasiswa" class="btn btn-submit flex-grow-1">
                                    Ajukan Beasiswa Sekarang
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="form-card" style="padding: 24px;">
                        <div class="section-title" style="margin-bottom: 16px;">Status & Riwayat Beasiswa</div>
                        @forelse($pengajuanSiswa as $p)
                            <div class="p-3 mb-3 rounded-4 shadow-sm border text-start" style="background: #fafbfc; border-color: #e2e8f0 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                                    <span class="fw-bold" style="font-size: 14px; color: #112250;">{{ $p->nama_beasiswa }}</span>
                                    @if($p->status == 'Diterima')
                                        <span class="badge bg-success rounded-pill px-3 py-1 text-white">Diterima</span>
                                    @elseif($p->status == 'Ditolak')
                                        <span class="badge bg-danger rounded-pill px-3 py-1 text-white">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-1">Menunggu</span>
                                    @endif
                                </div>
                                <div style="font-size: 13px; color: #5a6e9c; margin-bottom: 10px;">
                                    Siswa: <strong>{{ $p->nama }}</strong> (Kelas {{ $p->kelas }})
                                </div>
                                
                                @if($p->status == 'Diterima')
                                    <div class="alert alert-success p-3 rounded-3 text-start mb-0" style="font-size: 12px; line-height: 1.6; color: #0f5132; background-color: #d1e7dd; border: none;">
                                        🎉 <strong>Selamat!</strong> {{ $p->nama }} telah diterima program <strong>{{ $p->nama_beasiswa }}</strong>. Beasiswa ini berlaku selama <strong>{{ $p->durasi_potongan }}</strong> periode. Silakan daftar kembali setelah periode beasiswa habis.
                                    </div>
                                @elseif($p->status == 'Ditolak')
                                    <div class="alert alert-danger p-3 rounded-3 text-start mb-0" style="font-size: 12px; line-height: 1.6; color: #842029; background-color: #f8d7da; border: none;">
                                        ❌ <strong>Mohon Maaf!</strong> Pengajuan beasiswa Anda untuk {{ $p->nama }} belum berhasil. Silakan coba ajukan kembali.
                                    </div>
                                @else
                                    <div class="alert alert-info p-3 rounded-3 text-start mb-0" style="font-size: 12px; line-height: 1.6; color: #055160; background-color: #cff4fc; border: none;">
                                        ⏳ Pengajuan beasiswa untuk {{ $p->nama }} sedang menunggu verifikasi admin.
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted text-center py-4 mb-0" style="font-size: 13px;">Belum ada riwayat pengajuan beasiswa.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>

<script>
    function fetchLiveNotifications() {
        fetch('{{ route("ortu.notifications.count") }}')
            .then(res => res.json())
            .then(data => {
                const badgeTagihan = document.getElementById('badge-tagihan-ortu');
                if (badgeTagihan) {
                    if (data.notifTagihanOrtu > 0) {
                        badgeTagihan.innerText = data.notifTagihanOrtu;
                        badgeTagihan.style.display = 'inline';
                    } else {
                        badgeTagihan.style.display = 'none';
                    }
                }
                const badgeBeasiswa = document.getElementById('badge-beasiswa-ortu');
                if (badgeBeasiswa) {
                    if (data.notifBeasiswaOrtu > 0) {
                        badgeBeasiswa.innerText = data.notifBeasiswaOrtu;
                        badgeBeasiswa.style.display = 'inline';
                    } else {
                        badgeBeasiswa.style.display = 'none';
                    }
                }
            })
            .catch(err => console.error("Error fetching live notifications: ", err));
    }
    
    // Poll every 3 seconds
    setInterval(fetchLiveNotifications, 3000);
    // Initial fetch on load
    document.addEventListener('DOMContentLoaded', () => {
        fetchLiveNotifications();
        isiDataSiswa();
    });
</script>

</body>
</html>
