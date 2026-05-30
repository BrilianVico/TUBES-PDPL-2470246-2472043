<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - SMP Sunodia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* ===================== SIDEBAR ===================== */
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
            z-index: 100;
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
            text-align: left;
            color: #cbd5e1;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-size: 15px;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .menu a:hover,
        .menu a.active,
        .menu button:hover {
            background: rgba(255,255,255,0.12);
            color: #ffffff;
        }

        /* ===================== CONTENT ===================== */
        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .topbar {
            background: white;
            padding: 20px 30px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        /* ===================== CARD ===================== */
        .card-box {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
            overflow: visible !important;
            position: relative;
        }

        /* ===================== FILTER ===================== */
        .filter-box {
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 10px 14px;
            outline: none;
            background: white;
            position: relative;
            z-index: 9999;
            min-width: 160px;
        }

        .search-input {
            max-width: 300px;
        }

        /* ===================== TABLE ===================== */
        table {
            width: 100%;
        }

        table thead th {
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            border-bottom: 2px solid #e5e7eb;
        }

        table tbody td {
            vertical-align: middle;
        }

        .badge-kelas {
            background: #dbeafe;
            color: #1d4ed8;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>SMP Sunodia</h2>

    <div class="menu">
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.data-siswa') }}"
           class="{{ request()->routeIs('admin.data-siswa') ? 'active' : '' }}">
            Data Siswa
        </a>

        <a href="{{ route('admin.tagihan.index') }}"
           class="{{ request()->routeIs('admin.tagihan.*') ? 'active' : '' }}">
            Tagihan
        </a>
        <a href="{{ route('admin.pembayaran.index') }}"
           class="{{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
            Pembayaran
        </a>
        <a href="{{ route('admin.beasiswa.index') }}"
           class="{{ request()->routeIs('admin.beasiswa.*') ? 'active' : '' }}">
            Beasiswa
        </a>
        <a href="{{ route('admin.pengumuman.index') }}"
           class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
            Pengumuman
        </a>
        <a href="{{ route('admin.pengajuan.index') }}">
            Pengajuan Beasiswa
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="color:#fca5a5;">
                Logout
            </button>
        </form>
    </div>
</div>

<!-- Content -->
<div class="content">

    <!-- Topbar -->
    <div class="topbar">
        <div>
            <h1>Data Master Siswa</h1>
            <p class="text-muted mb-0">
                Kelola data siswa berdasarkan kelas
            </p>
        </div>

        <span class="badge bg-primary px-3 py-2 fs-6">
            Total: {{ $siswa->count() }} Siswa
        </span>
    </div>

    <!-- Card -->
    <div class="card-box">

        <!-- Filter -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <form method="GET">
                <select name="id_kelas"
                        class="filter-box"
                        onchange="this.form.submit()">
                    <option value="">Semua Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}"
                            {{ $idKelas == $k->id_kelas ? 'selected' : '' }}>
                            Kelas {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </form>

            <input type="text"
                   id="searchSiswa"
                   class="form-control search-input"
                   placeholder="Cari siswa...">
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="tabelSiswa">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Wali Murid</th>
                    <th>NIK Wali</th>
                    <th>Angkatan</th>
                </tr>
                </thead>
                <tbody>
                @forelse($siswa as $s)
                    <tr>
                        <td class="fw-bold">{{ $s->nis }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>
                            <span class="badge-kelas">
                                {{ $s->nama_kelas }}
                            </span>
                        </td>
                        <td>{{ $s->nama_wali ?? '-' }}</td>
                        <td><code>{{ $s->nik_wali ?? '-' }}</code></td>
                        <td>20{{ $s->angkatan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Data siswa tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    document.getElementById('searchSiswa').addEventListener('keyup', function () {
        let keyword = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tabelSiswa tbody tr');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>

</body>
</html>
