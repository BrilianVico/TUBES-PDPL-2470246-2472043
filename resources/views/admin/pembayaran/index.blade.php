<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran - SMP Sunodia</title>
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
            box-shadow: 4px 0 20px rgba(23,109,76,.25);
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

        .table th {
            font-size: 12px;
            text-transform: uppercase;
            color: #64748b;
            border-top: none;
        }

        .table td {
            vertical-align: middle;
        }

        .badge-status {
            padding: 8px 12px;
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

        .btn {
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 12px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div style="text-align:center;margin-bottom:35px;">
        <img src="{{ asset('IMG/ImageLogo.png') }}"
             style="width:70px;margin-bottom:10px;">

        <h2 style="margin:0;font-size:22px;">
            Sunodia
        </h2>

        <p style="font-size:12px;opacity:.8;margin-top:5px;">
            Portal Admin
        </p>
    </div>

    <div class="menu">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.data-siswa') }}">Data Siswa</a>
        <a href="{{ route('admin.tagihan.index') }}">Tagihan</a>
        <a href="{{ route('admin.pembayaran.index') }}" class="active">Pembayaran</a>
        <a href="{{ route('admin.beasiswa.index') }}">Beasiswa</a>
        <a href="{{ route('admin.pengumuman.index') }}">Pengumuman</a>
        <a href="{{ route('admin.pengajuan.index') }}">
            Pengajuan Beasiswa
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    style="
                width:100%;
                padding:14px 18px;
                border:none;
                border-radius:14px;
                background:rgba(239,68,68,.15);
                color:#fecaca;
                font-weight:600;
                cursor:pointer;">
                Logout
            </button>
        </form>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <h1>Data Pembayaran</h1>
        <p>Verifikasi pembayaran yang dikirim oleh orang tua siswa.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-box">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Tagihan</th>
                    <th>Nominal</th>
                    <th>Bukti Transfer</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th width="250">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pembayaran as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $item->tanggal_bayar
                                ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y')
                                : '-' }}
                        </td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_tagihan }}</td>
                        <td>Rp {{ number_format($item->nominal_bayar, 0, ',', '.') }}</td>
                        <td>
                            @if($item->bukti_transfer)
                                <a href="{{ asset('storage/bukti-transfer/' . $item->bukti_transfer) }}"
                                   target="_blank"
                                   class="btn btn-info btn-sm">
                                    Lihat Bukti
                                </a>
                            @else
                                <span class="text-muted">
            Belum Upload
        </span>
                            @endif
                        </td>

                        <td>
                            {{ $item->catatan ?? '-' }}
                        </td>
                        <td>
                            @if($item->status_bayar == 'LUNAS')
                                <span class="badge-status badge-lunas">
                                    Lunas
                                </span>
                            @else
                                <span class="badge-status badge-belum">
                                    Menunggu
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($item->status_bayar != 'LUNAS')
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.pembayaran.approve', $item->id_pembayaran) }}"
                                          method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-success btn-sm">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.pembayaran.reject', $item->id_pembayaran) }}"
                                          method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-success fw-semibold">
                                    ✔ Sudah Diverifikasi
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted">
                            Belum ada data pembayaran.
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
