<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Beasiswa - SMP Sunodia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        .text-muted {
            font-size: 13px;
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
        <a href="{{ route('admin.beasiswa.index') }}" class="active">Beasiswa</a>
        <a href="#">Pengumuman</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <h1>Edit Beasiswa</h1>
        <p>Perbarui informasi program beasiswa.</p>
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
        <form action="{{ route('admin.beasiswa.update', $beasiswa->id_beasiswa) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Nama Beasiswa</label>
                <input type="text"
                       name="nama_beasiswa"
                       class="form-control"
                       value="{{ old('nama_beasiswa', $beasiswa->nama_beasiswa) }}"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="4">{{ old('deskripsi', $beasiswa->deskripsi) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Persentase Potongan (%)</label>
                <input type="number"
                       name="persentase_potongan"
                       class="form-control"
                       min="0"
                       max="100"
                       step="0.01"
                       value="{{ old('persentase_potongan', $beasiswa->persentase_potongan) }}"
                       required>

                <small class="text-muted">
                    Contoh:
                    100 = Gratis penuh,
                    50 = Diskon 50%,
                    25 = Diskon 25%.
                </small>
            </div>

            <div class="mb-4">
                <label class="form-label">Kuota</label>
                <input type="number"
                       name="kuota"
                       class="form-control"
                       value="{{ old('kuota', $beasiswa->kuota) }}"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Aktif"
                        {{ old('status', $beasiswa->status) == 'Aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="Nonaktif"
                        {{ old('status', $beasiswa->status) == 'Nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.beasiswa.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary-custom">
                    Update Beasiswa
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
