<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Beasiswa - SMP Sunodia</title>
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
            background: linear-gradient(180deg, #176d4c, #0f5132);
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
        .form-select,
        .input-group-text {
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .input-group-text {
            font-weight: 600;
            color: #64748b;
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

        .text-muted {
            font-size: 13px;
            display: block;
            margin-top: 6px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div style="text-align:center;margin-bottom:35px;">
        <img src="{{ asset('IMG/ImageLogo.png') }}" style="width:70px;margin-bottom:10px;">
        <h2 style="margin:0;font-size:22px;">Sunodia</h2>
        <p style="font-size:12px;opacity:.8;margin-top:5px;">Portal Admin</p>
    </div>

    <div class="menu">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.data-siswa') }}" class="{{ request()->routeIs('admin.data-siswa*') ? 'active' : '' }}">Data Siswa</a>
        <a href="{{ route('admin.tagihan.index') }}" class="{{ request()->routeIs('admin.tagihan.*') ? 'active' : '' }}">Tagihan</a>
        <a href="{{ route('admin.pembayaran.index') }}" class="{{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">Pembayaran</a>
        <a href="{{ route('admin.beasiswa.index') }}" class="active">Beasiswa</a>
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
        <h1>Tambah Beasiswa</h1>
        <p>Buat program beasiswa baru dengan ketentuan potongan nominal atau persentase.</p>
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
        <form action="{{ route('admin.beasiswa.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label">Nama Beasiswa</label>
                <input type="text" name="nama_beasiswa" class="form-control" value="{{ old('nama_beasiswa') }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Jenis Potongan</label>
                    <select name="jenis_potongan" id="jenis_potongan" class="form-select" required>
                        <option value="PERSEN" {{ old('jenis_potongan') == 'PERSEN' ? 'selected' : '' }}>Persentase (%)</option>
                        <option value="NOMINAL" {{ old('jenis_potongan') == 'NOMINAL' ? 'selected' : '' }}>Nominal (Rp)</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Nilai Potongan</label>
                    <div class="input-group">
                        <span class="input-group-text" id="simbolPotongan">%</span>
                        <input type="number" name="nilai_potongan" class="form-control" step="0.01" value="{{ old('nilai_potongan') }}" required>
                    </div>
                    <small class="text-muted" id="panduanPotongan">
                        Jika Jenis PERSEN isi 30 berarti diskon potongan sebesar 30%.
                    </small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Berlaku Untuk</label>
                    <select name="berlaku_untuk" class="form-select" required>
                        <option value="SEMUA" {{ old('berlaku_untuk') == 'SEMUA' ? 'selected' : '' }}>Semua Tagihan</option>
                        <option value="SPP" {{ old('berlaku_untuk') == 'SPP' ? 'selected' : '' }}>SPP</option>
                        <option value="Buku" {{ old('berlaku_untuk') == 'Buku' ? 'selected' : '' }}>Buku</option>
                        <option value="Seragam" {{ old('berlaku_untuk') == 'Seragam' ? 'selected' : '' }}>Seragam</option>
                        <option value="Ujian" {{ old('berlaku_untuk') == 'Ujian' ? 'selected' : '' }}>Ujian</option>
                        <option value="Kegiatan" {{ old('berlaku_untuk') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Pembangunan" {{ old('berlaku_untuk') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Kuota Penerima</label>
                    <input type="number" name="kuota" class="form-control" value="{{ old('kuota') }}" min="1" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="AKTIF" {{ old('status') == 'AKTIF' ? 'selected' : '' }}>Aktif</option>
                    <option value="NONAKTIF" {{ old('status') == 'NONAKTIF' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary-custom">Simpan Beasiswa</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jenisPotongan = document.getElementById('jenis_potongan');
        const simbolPotongan = document.getElementById('simbolPotongan');
        const panduanPotongan = document.getElementById('panduanPotongan');

        function updateFormatUI() {
            if (jenisPotongan.value === 'PERSEN') {
                simbolPotongan.textContent = '%';
                panduanPotongan.textContent = 'Jika Jenis PERSEN isi 30 berarti diskon potongan sebesar 30%.';
            } else {
                simbolPotongan.textContent = 'Rp';
                panduanPotongan.textContent = 'Jika Jenis NOMINAL isi 100000 berarti diskon potongan sebesar Rp100.000.';
            }
        }

        jenisPotongan.addEventListener('change', updateFormatUI);
        updateFormatUI();
    });
</script>

</body>
</html>
