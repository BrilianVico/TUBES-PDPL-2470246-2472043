<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Tagihan - SMP Sunodia</title>
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
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
            font-weight: 700;
        }

        .menu a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-size: 15px;
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
            font-size: 16px;
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
            letter-spacing: 0.4px;
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

        .form-check-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px 18px;
        }

        .btn {
            border-radius: 12px;
            padding: 10px 22px;
            font-weight: 600;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: none;
            color: white;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
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
        <a href="{{ route('admin.tagihan.index') }}" class="active">Tagihan</a>
        <a href="#">Pembayaran</a>
        <a href="#">Beasiswa</a>
        <a href="#">Pengumuman</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <h1>Generate Tagihan</h1>
        <p>Buat tagihan untuk satu siswa atau seluruh siswa sekaligus.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-box">
        <form action="{{ route('admin.tagihan.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label">Mode Generate</label>
                <div class="form-check-box">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="mode_generate" id="modeSemua" value="semua" checked>
                        <label class="form-check-label" for="modeSemua">
                            Generate untuk semua siswa aktif
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="mode_generate" id="modeSatu" value="satu">
                        <label class="form-check-label" for="modeSatu">
                            Generate untuk satu siswa tertentu
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-4" id="siswaWrapper" style="display:none;">
                <label class="form-label">Pilih Siswa</label>
                <select name="id_siswa" class="form-select">
                    <option value="">Pilih Siswa</option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->id_siswa }}" {{ old('id_siswa') == $s->id_siswa ? 'selected' : '' }}>
                            {{ $s->nis }} - {{ $s->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Jenis Tagihan</label>
                <select name="jenis_tagihan" class="form-select" required>
                    <option value="SPP">SPP Bulanan</option>
                    <option value="Buku">Uang Buku</option>
                    <option value="Seragam">Uang Seragam</option>
                    <option value="Pembangunan">Uang Pembangunan</option>
                    <option value="Ujian">Biaya Ujian</option>
                    <option value="Kegiatan">Biaya Kegiatan</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <label class="form-label">Bulan</label>
                    <select name="bulan" class="form-select" required>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                            <option value="{{ $bulan }}" {{ old('bulan') == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-4">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" value="{{ old('tahun', date('Y')) }}" required>
                </div>

                <div class="col-md-4 mb-4">
                    <label class="form-label">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran', '2025/2026') }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Beasiswa</label>
                <select name="beasiswa" class="form-select">
                    <option value="0">Tidak</option>
                    <option value="1">Ya (Potongan Beasiswa)</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.tagihan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary-custom">
                    Generate Tagihan
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    const modeSemua = document.getElementById('modeSemua');
    const modeSatu = document.getElementById('modeSatu');
    const siswaWrapper = document.getElementById('siswaWrapper');

    function toggleSiswa() {
        siswaWrapper.style.display = modeSatu.checked ? 'block' : 'none';
    }

    modeSemua.addEventListener('change', toggleSiswa);
    modeSatu.addEventListener('change', toggleSiswa);
    toggleSiswa();
</script>

</body>
</html>
