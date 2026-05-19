<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengumuman - SMP Sunodia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f5f9;
            color: #0f172a;
        }

        /* Sidebar */
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

        /* Content */
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

        .judul {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .isi-preview {
            color: #64748b;
            font-size: 14px;
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
        <a href="{{ route('admin.pembayaran.index') }}"
           class="{{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
            Pembayaran
        </a>
        <a href="{{ route('admin.beasiswa.index') }}">Beasiswa</a>
        <a href="{{ route('admin.pengumuman.index') }}"
           class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
            Pengumuman
        </a>


        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <h1>Data Pengumuman</h1>
        <p>Kelola pengumuman yang akan tampil pada akun orang tua.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold">Daftar Pengumuman</h5>

            <a href="{{ route('admin.pengumuman.create') }}"
               class="btn btn-primary-custom">
                + Tambah Pengumuman
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Periode</th>
                    <th>Target</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pengumuman as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <div class="judul">{{ $item->judul }}</div>
                            <div class="isi-preview">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 80) }}
                            </div>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                            <br>
                            <small class="text-muted">
                                s/d
                                {{ $item->tanggal_selesai
                                    ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y')
                                    : '-' }}
                            </small>
                        </td>

                        <td>{{ $item->target }}</td>

                        <td>
                            <span class="badge
                                @if($item->status == 'Aktif') bg-success
                                @elseif($item->status == 'Draft') bg-warning text-dark
                                @else bg-secondary
                                @endif">
                                {{ $item->status }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('admin.pengumuman.edit', $item->id_pengumuman) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.pengumuman.destroy', $item->id_pengumuman) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
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
                            Belum ada pengumuman.
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
