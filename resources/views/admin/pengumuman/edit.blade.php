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
            color: #0f172a;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg,#176d4c,#0f5132);
            color: white;
            padding: 30px 20px;
            box-shadow: 10px 0 40px rgba(0,0,0,.12);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
            font-weight: 700;
        }

        .menu a,
        .menu button {
            display: block;
            width: 100%;
            padding: 14px 18px;
            margin-bottom: 10px;
            border-radius: 14px;
            color: #cbd5e1;
            text-decoration: none;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.25s ease;
        }

        .menu a:hover,
        .menu a.active,
        .menu button:hover {
            background: rgba(255,255,255,.15);
            color:white;
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .topbar {
            background: linear-gradient(135deg,#176d4c,#0f5132);
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
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
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
            background: #f8fafc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #176d4c;
            box-shadow: 0 0 0 0.2rem rgba(23, 109, 76, 0.12);
        }

        .btn {
            border-radius: 12px;
            padding: 10px 22px;
            font-weight: 600;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg,#176d4c,#0f5132);
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
    </style>
</head>
<body>

<div class="sidebar">
    <div style="text-align:center;margin-bottom:35px;">
        <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo" style="width:70px;margin-bottom:10px;">
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
        <a href="{{ route('admin.pengajuan.index') }}" class="{{ request()->routeIs('admin.pengajuan.*') ? 'active' : '' }}">Pengajuan Beasiswa</a>

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
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                           value="{{ old('tanggal_selesai', $pengumuman->tanggal_selesai ? date('Y-m-d', strtotime($pengumuman->tanggal_selesai)) : '') }}">
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
    });
</script>

</body>
</html>
