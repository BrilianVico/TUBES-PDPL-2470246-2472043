<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Beasiswa - SMP Sunodia</title>
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

        .table th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border: none;
            padding: 14px;
        }

        .table td {
            padding: 14px;
            vertical-align: middle;
            border-color: #f1f5f9;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 600;
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
        <h1>Data Beasiswa</h1>
        <p>Kelola program beasiswa untuk siswa SMP Sunodia.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold">Daftar Program Beasiswa</h5>

            <a href="{{ route('admin.beasiswa.create') }}"
               class="btn btn-primary-custom">
                + Tambah Beasiswa
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Beasiswa</th>
                    <th>Nominal Potongan</th>
                    <th>Kuota</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($beasiswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-semibold">{{ $item->nama_beasiswa }}</div>
                            <small class="text-muted">
                                {{ $item->deskripsi }}
                            </small>
                        </td>
                        <td>
                            Rp {{ number_format($item->nominal_potongan, 0, ',', '.') }}
                        </td>
                        <td>{{ $item->kuota }}</td>
                        <td>
                            <span class="badge {{ $item->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.beasiswa.edit', $item->id_beasiswa) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.beasiswa.destroy', $item->id_beasiswa) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="text-center text-muted py-4">
                            Belum ada data beasiswa.
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
