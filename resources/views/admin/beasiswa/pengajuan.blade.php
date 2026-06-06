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
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .topbar {
            background: linear-gradient(135deg, #176d4c, #0f5132);
            color: white;
            border-radius: 24px;
            padding: 30px 36px;
            box-shadow: 0 12px 32px rgba(23,109,76,.15);
            margin-bottom: 28px;
        }

        .topbar h1 {
            font-size: 44px;
            font-weight: 800;
            margin-bottom: 6px;
            color: white;
        }

        .topbar p {
            margin: 0;
            color: rgba(255,255,255,.85);
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

        .btn-sm {
            border-radius: 8px;
            padding: 6px 14px;
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
        <a href="{{ route('admin.beasiswa.index') }}" class="{{ request()->routeIs('admin.beasiswa.index') ? 'active' : '' }}">Beasiswa</a>
        <a href="{{ route('admin.pengumuman.index') }}" class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">Pengumuman</a>
        <a href="{{ route('admin.pengajuan.index') }}" class="active">Pengajuan Beasiswa</a>

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
                    <th>Beasiswa</th>
                    <th>Jenis</th>
                    <th>Nilai</th>
                    <th>Berlaku Untuk</th>
                    <th>Kelas</th>
                    <th>Kuota Beasiswa</th>
                    <th>Rata-rata</th>
                    <th>Status</th>
                    <th width="160" class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pengajuan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->nama }}</td>
                        <td><strong>{{ $item->nama_beasiswa }}</strong></td>
                        <td>{{ $item->jenis_potongan }}</td>
                        <td>
                            @if($item->jenis_potongan == 'PERSEN')
                                {{ $item->nilai_potongan }}%
                            @else
                                Rp {{ number_format($item->nilai_potongan,0,',','.') }}
                            @endif
                        </td>
                        <td>{{ $item->berlaku_untuk }}</td>

                        {{-- PERBAIKAN: Menukar posisi kolom Kelas dan Kuota agar sesuai header --}}
                        <td>{{ $item->kelas ?? '-' }}</td>
                        <td>
                            @if($item->kuota > 0)
                                <span class="badge bg-success">{{ $item->kuota }} Slot</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>

                        <td>{{ number_format($item->rata_rata, 2) }}</td>
                        <td>
                            @if($item->status == 'Menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($item->status == 'Diterima')
                                <span class="badge bg-success">Diterima</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status == 'Menunggu')
                                <form action="{{ route('admin.pengajuan.approve', $item->id_pengajuan) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui pengajuan ini?')">
                                        ACC
                                    </button>
                                </form>

                                <form action="{{ route('admin.pengajuan.reject', $item->id_pengajuan) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pengajuan ini?')">
                                        Tolak
                                    </button>
                                </form>
                            @else
                                <span class="text-muted fs-7">Sudah Diproses</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center py-4 text-muted">
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
