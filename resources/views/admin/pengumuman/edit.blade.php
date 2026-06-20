<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengumuman - SMP Sunodia</title>
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
            color:white;
            border-radius:24px;
            padding:30px 36px;
            box-shadow:0 12px 32px rgba(23,109,76,.15);
            margin-bottom:28px;
        }

        .topbar h1 {
            font-size: 44px;
            font-weight: 800;
            margin-bottom: 6px;
            color:white;
        }

        .topbar p {
            margin:0;
            color:rgba(255,255,255,.85);
            font-size:16px;
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

        .form-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
            background: #F5F0E9;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3C507D;
            box-shadow: 0 0 0 0.2rem rgba(23, 109, 76, 0.12);
        }

        .btn {
            border-radius: 12px;
            padding: 10px 22px;
            font-weight: 600;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg,#3C507D,#112250);
            border:none;
            color:white;
            box-shadow:0 8px 20px rgba(23,109,76,.25);
        }

        .btn-primary-custom:hover {
            color: white;
            opacity: 0.95;
        }

        .alert {
            border: none;
            border-radius: 14px;
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
        <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo" style="width: 95px;margin-bottom:10px;">
        <h2 style="margin:0;font-size:22px;">Sunodia</h2>
        <p style="font-size:12px;opacity:.8;margin-top:5px;">Portal Admin</p>
    </div>

    <div class="menu">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.data-siswa') }}" class="{{ request()->routeIs('admin.data-siswa*') ? 'active' : '' }}">Data Siswa</a>
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
        <h1>Edit Pengumuman</h1>
        <p>Perbarui informasi pengumuman untuk orang tua.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-box">
        <form action="{{ route('admin.pengumuman.update', $pengumuman->id_pengumuman) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Judul Pengumuman</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $pengumuman->judul) }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Isi Pengumuman</label>
                <textarea name="isi" class="form-control" rows="6" required>{{ old('isi', $pengumuman->isi) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control"
                           value="{{ old('tanggal_mulai', $pengumuman->tanggal_mulai ? date('Y-m-d', strtotime($pengumuman->tanggal_mulai)) : '') }}" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Tanggal Selesai (Otomatis 1 Bulan)</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                           value="{{ old('tanggal_selesai', $pengumuman->tanggal_selesai ? date('Y-m-d', strtotime($pengumuman->tanggal_selesai)) : '') }}" readonly style="background-color: #e2e8f0; cursor: not-allowed;">
                </div>
            </div>

            @php
                $selectedTarget = old('target');
                if (!$selectedTarget) {
                    if (str_starts_with($pengumuman->target, 'Kelas:')) {
                        $selectedTarget = 'Kelas Tertentu';
                    } elseif (str_starts_with($pengumuman->target, 'Siswa:')) {
                        $selectedTarget = 'Siswa Tertentu';
                    } else {
                        $selectedTarget = 'Semua Orang Tua';
                    }
                }

                // Ambil string murni nama kelas atau ID Siswa jika format datanya "Kelas: VII-A" atau "Siswa: 12"
                $kelasTarget = trim(str_replace('Kelas:', '', $pengumuman->target));
                $siswaTarget = trim(str_replace('Siswa:', '', $pengumuman->target));
            @endphp

            <div class="mb-4">
                <label class="form-label">Target Pengumuman</label>
                <select name="target" id="target" class="form-select" required>
                    <option value="Semua Orang Tua" {{ $selectedTarget == 'Semua Orang Tua' ? 'selected' : '' }}>Semua Orang Tua</option>
                    <option value="Kelas Tertentu" {{ $selectedTarget == 'Kelas Tertentu' ? 'selected' : '' }}>Kelas Tertentu</option>
                    <option value="Siswa Tertentu" {{ $selectedTarget == 'Siswa Tertentu' ? 'selected' : '' }}>Siswa Tertentu</option>
                </select>
            </div>

            <div class="mb-4" id="kelas-container" style="display: none;">
                <label class="form-label">Pilih Kelas</label>
                <select name="kelas_target" class="form-select">
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $item)
                        <option value="{{ $item->nama_kelas }}" {{ old('kelas_target', $kelasTarget) == $item->nama_kelas ? 'selected' : '' }}>
                            {{ $item->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4" id="siswa-container" style="display: none;">
                <label class="form-label">Pilih Siswa</label>
                <select name="id_siswa_target" class="form-select">
                    <option value="">Pilih Siswa</option>
                    @foreach($siswa as $item)
                        <option value="{{ $item->id_siswa }}" {{ old('id_siswa_target', $siswaTarget) == $item->id_siswa ? 'selected' : '' }}>
                            {{ $item->nis }} - {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Aktif" {{ old('status', $pengumuman->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Draft" {{ old('status', $pengumuman->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Nonaktif" {{ old('status', $pengumuman->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary-custom">Update Pengumuman</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const target = document.getElementById('target');
        const kelasContainer = document.getElementById('kelas-container');
        const siswaContainer = document.getElementById('siswa-container');

        function toggleTargetFields() {
            kelasContainer.style.display = 'none';
            siswaContainer.style.display = 'none';

            if (target.value === 'Kelas Tertentu') {
                kelasContainer.style.display = 'block';
            } else if (target.value === 'Siswa Tertentu') {
                siswaContainer.style.display = 'block';
            }
        }

        target.addEventListener('change', toggleTargetFields);
        toggleTargetFields(); // Jalankan otomatis saat halaman selesai dimuat

        const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]');
        const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]');

        function updateTanggalSelesai() {
            if (tanggalMulai.value) {
                const date = new Date(tanggalMulai.value);
                date.setMonth(date.getMonth() + 1);
                const yyyy = date.getFullYear();
                let mm = date.getMonth() + 1;
                let dd = date.getDate();
                if (mm < 10) mm = '0' + mm;
                if (dd < 10) dd = '0' + dd;
                tanggalSelesai.value = `${yyyy}-${mm}-${dd}`;
            }
        }

        tanggalMulai.addEventListener('change', updateTanggalSelesai);
    });
</script>

</body>
</html>
