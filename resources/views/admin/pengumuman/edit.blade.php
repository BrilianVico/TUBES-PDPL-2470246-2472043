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
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: white;
            padding: 30px 20px;
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
            background: rgba(255,255,255,0.10);
            color: #ffffff;
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .topbar {
            background: #ffffff;
            border-radius: 24px;
            padding: 30px 36px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
            margin-bottom: 28px;
        }

        .topbar h1 {
            font-size: 44px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .topbar p {
            margin: 0;
            color: #64748b;
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
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.12);
        }

        .btn {
            border-radius: 12px;
            padding: 10px 22px;
            font-weight: 600;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: none;
            color: white;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.25);
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
    <h2>SMP Sunodia</h2>

    <div class="menu">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.data-siswa') }}">Data Siswa</a>
        <a href="{{ route('admin.tagihan.index') }}">Tagihan</a>
        <a href="#">Pembayaran</a>
        <a href="{{ route('admin.beasiswa.index') }}">Beasiswa</a>
        <a href="{{ route('admin.pengumuman.index') }}" class="active">Pengumuman</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
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
        <form action="{{ route('admin.pengumuman.update', $pengumuman->id_pengumuman) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Judul Pengumuman</label>
                <input type="text"
                       name="judul"
                       class="form-control"
                       value="{{ old('judul', $pengumuman->judul) }}"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Isi Pengumuman</label>
                <textarea name="isi"
                          class="form-control"
                          rows="6"
                          required>{{ old('isi', $pengumuman->isi) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date"
                           name="tanggal_mulai"
                           class="form-control"
                           value="{{ old('tanggal_mulai', optional($pengumuman->tanggal_mulai)->format('Y-m-d')) }}"
                           required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date"
                           name="tanggal_selesai"
                           class="form-control"
                           value="{{ old('tanggal_selesai', optional($pengumuman->tanggal_selesai)->format('Y-m-d')) }}">
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

                $kelasTarget = str_replace('Kelas: ', '', $pengumuman->target);
            @endphp

            <div class="mb-4">
                <label class="form-label">Target Pengumuman</label>
                <select name="target"
                        id="target"
                        class="form-select"
                        required>
                    <option value="Semua Orang Tua"
                        {{ $selectedTarget == 'Semua Orang Tua' ? 'selected' : '' }}>
                        Semua Orang Tua
                    </option>
                    <option value="Kelas Tertentu"
                        {{ $selectedTarget == 'Kelas Tertentu' ? 'selected' : '' }}>
                        Kelas Tertentu
                    </option>
                    <option value="Siswa Tertentu"
                        {{ $selectedTarget == 'Siswa Tertentu' ? 'selected' : '' }}>
                        Siswa Tertentu
                    </option>
                </select>
            </div>

            <div class="mb-4"
                 id="kelas-container"
                 style="display: none;">
                <label class="form-label">Pilih Kelas</label>
                <select name="kelas_target" class="form-select">
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $item)
                        <option value="{{ $item->nama_kelas }}"
                            {{ old('kelas_target', $kelasTarget) == $item->nama_kelas ? 'selected' : '' }}>
                            {{ $item->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4"
                 id="siswa-container"
                 style="display: none;">
                <label class="form-label">Pilih Siswa</label>
                <select name="id_siswa_target" class="form-select">
                    <option value="">Pilih Siswa</option>
                    @foreach($siswa as $item)
                        <option value="{{ $item->id_siswa }}">
                            {{ $item->nis }} - {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Aktif"
                        {{ old('status', $pengumuman->status) == 'Aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="Draft"
                        {{ old('status', $pengumuman->status) == 'Draft' ? 'selected' : '' }}>
                        Draft
                    </option>
                    <option value="Nonaktif"
                        {{ old('status', $pengumuman->status) == 'Nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pengumuman.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary-custom">
                    Update Pengumuman
                </button>
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
            }

            if (target.value === 'Siswa Tertentu') {
                siswaContainer.style.display = 'block';
            }
        }

        target.addEventListener('change', toggleTargetFields);
        toggleTargetFields();
    });
</script>

</body>
</html>
