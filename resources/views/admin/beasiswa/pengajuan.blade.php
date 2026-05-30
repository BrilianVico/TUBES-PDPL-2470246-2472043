<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Beasiswa - SMP Sunodia</title>

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

        .table th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            border: none;
            padding: 14px;
        }

        .table td {
            padding: 14px;
            vertical-align: middle;
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
        <a href="{{ route('admin.pembayaran.index') }}">Pembayaran</a>
        <a href="{{ route('admin.beasiswa.index') }}">Beasiswa</a>
        <a href="{{ route('admin.pengumuman.index') }}">Pengumuman</a>

        <a href="{{ route('admin.pengajuan.index') }}"
           class="active">
            Pengajuan Beasiswa
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>


</div>

<div class="content">


    <div class="topbar">
        <h1>Pengajuan Beasiswa</h1>
        <p>Kelola pengajuan beasiswa dari wali murid.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-box">

        <div class="table-responsive">
            <table class="table align-middle">

                <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Rata-rata</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>
                </thead>

                <tbody>

                @forelse($pengajuan as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->nis }}</td>

                        <td>{{ $item->nama }}</td>

                        <td>{{ $item->kelas }}</td>

                        <td>
                            {{ number_format($item->rata_rata, 2) }}
                        </td>

                        <td>

                            @if($item->status == 'Menunggu')
                                <span class="badge bg-warning text-dark">
                                Menunggu
                            </span>

                            @elseif($item->status == 'Diterima')
                                <span class="badge bg-success">
                                Diterima
                            </span>

                            @else
                                <span class="badge bg-danger">
                                Ditolak
                            </span>
                            @endif

                        </td>

                        <td>

                            @if($item->status == 'Menunggu')

                                <form
                                    action="{{ route('admin.pengajuan.approve', $item->id_pengajuan) }}"
                                    method="POST"
                                    class="d-inline"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Setujui pengajuan ini?')"
                                    >
                                        ACC
                                    </button>
                                </form>

                                <form
                                    action="{{ route('admin.pengajuan.reject', $item->id_pengajuan) }}"
                                    method="POST"
                                    class="d-inline"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Tolak pengajuan ini?')"
                                    >
                                        Tolak
                                    </button>
                                </form>

                            @else

                                <span class="text-muted">
                                Sudah Diproses
                            </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada pengajuan beasiswa.
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
