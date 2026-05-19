
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tagihan - SMP Sunodia</title>
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
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff;
        }

        /* Content */
        .content {
            margin-left: 260px;
            padding: 40px;
        }

        /* Header */
        .topbar {
            background: #ffffff;
            border-radius: 24px;
            padding: 30px 36px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .topbar h1 {
            font-size: 44px;
            font-weight: 800;
            margin-bottom: 6px;
            color: #0f172a;
        }

        .topbar p {
            margin: 0;
            color: #64748b;
            font-size: 16px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 12px 22px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        }

        .btn-primary-custom:hover {
            color: white;
            opacity: 0.95;
        }

        /* Card */
        .card-box {
            background: white;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
        }

        /* Table */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            font-size: 12px;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 700;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 12px;
            letter-spacing: 0.4px;
        }

        .table tbody td {
            padding: 16px 12px;
            border-color: #eef2f7;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        /* Status Badge */
        .badge-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-lunas {
            background: #dcfce7;
            color: #166534;
        }

        .badge-belum {
            background: #fef3c7;
            color: #92400e;
        }

        /* Action Buttons */
        .btn-edit {
            background: #facc15;
            color: #713f12;
            border: none;
        }

        .btn-edit:hover {
            background: #eab308;
            color: #713f12;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
        }

        .btn-sm {
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .alert {
            border: none;
            border-radius: 14px;
            padding: 14px 18px;
        }

        .empty-state {
            text-align: center;
            padding: 50px 0;
            color: #94a3b8;
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


        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <div>
            <h1>Data Tagihan</h1>
            <p>Kelola seluruh tagihan siswa SMP Sunodia</p>
        </div>

        <a href="{{ route('admin.tagihan.create') }}" class="btn-primary-custom">
            + Tambah Tagihan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="card-box">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Tagihan</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tagihan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_tagihan }}</td>
                        <td>{{ $item->bulan }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td>
                            @if(strtoupper($item->status) == 'LUNAS')
                                <span class="badge-status badge-lunas">Lunas</span>
                            @else
                                <span class="badge-status badge-belum">Belum Lunas</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.tagihan.edit', $item->id_tagihan) }}"
                               class="btn btn-sm btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('admin.tagihan.destroy', $item->id_tagihan) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                Belum ada data tagihan.
                            </div>
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
