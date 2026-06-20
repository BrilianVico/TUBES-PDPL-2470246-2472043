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
            color: #112250;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #112250, #08122d);
            color: white;
            padding: 35px 24px;
            box-shadow: 5px 0 35px rgba(17, 34, 80, 0.15);
            border-right: 1px solid rgba(224, 181, 143, 0.1);
            z-index: 100;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
            font-weight: 700;
        }

        .menu a, .menu button {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(245, 240, 233, 0.75);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 14px;
            font-weight: 500;
            border: 1px solid transparent;
            width: 100%;
            background: transparent;
            cursor: pointer;
        }

        .menu a:hover, .menu a.active, .menu button:hover, .menu button.active {
            background: rgba(224, 181, 143, 0.12) !important;
            color: #E0C58F !important;
            border-color: rgba(224, 181, 143, 0.25);
            transform: translateX(4px);
        }

        /* Tambahan CSS khusus untuk angka notifikasi merah di sidebar */
        .badge-notif-sidebar {
            background: #ef4444 !important;
            color: #ffffff !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            padding: 2px 8px !important;
            border-radius: 20px !important;
            margin-left: auto; /* Dorong ke kanan ujung menu */
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .topbar {
            background: linear-gradient(135deg, #3C507D, #112250);
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
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px -5px rgba(17, 34, 80, 0.05), 0 5px 15px -5px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(217, 203, 194, 0.45);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .table th {
            background: #F5F0E9;
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

        .card:hover, .card-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 45px -10px rgba(17, 34, 80, 0.08), 0 10px 20px -5px rgba(0, 0, 0, 0.04);
            border-color: rgba(224, 181, 143, 0.6);
        }

        /* Premium Action Button Styles */
        .btn-primary-custom, .btn-add, .btn-submit, .btn-login, .btn-register, .btn-bayar, .btn-detail, .btn-save, .btn-primary {
            background: linear-gradient(135deg, #3C507D, #112250) !important;
            color: #ffffff !important;
            border: 1px solid rgba(224, 181, 143, 0.3) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            padding: 10px 20px !important;
            box-shadow: 0 4px 15px rgba(17, 34, 80, 0.15) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            cursor: pointer !important;
        }
        .btn-primary-custom:hover, .btn-add:hover, .btn-submit:hover, .btn-login:hover, .btn-register:hover, .btn-bayar:hover, .btn-detail:hover, .btn-save:hover, .btn-primary:hover {
            background: linear-gradient(135deg, #112250, #08122d) !important;
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 20px rgba(17, 34, 80, 0.25) !important;
            border-color: rgba(224, 181, 143, 0.6) !important;
            color: #E0C58F !important;
        }
        .btn-primary-custom:active, .btn-add:active, .btn-submit:active, .btn-login:active, .btn-register:active, .btn-bayar:active, .btn-detail:active, .btn-save:active, .btn-primary:active {
            transform: translateY(0) scale(0.98) !important;
        }

        /* Success & Other Accent Buttons */
        .btn-success, .btn-edit, .btn-edit-custom {
            background: #E0C58F !important;
            color: #112250 !important;
            border: 1px solid rgba(17, 34, 80, 0.1) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 4px 12px rgba(224, 181, 143, 0.2) !important;
        }
        .btn-success:hover, .btn-edit:hover, .btn-edit-custom:hover {
            background: #D9CBC2 !important;
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 16px rgba(224, 181, 143, 0.35) !important;
            color: #112250 !important;
        }

        /* Secondary Back Buttons */
        .btn-secondary, .btn-back {
            background: #F5F0E9 !important;
            color: #3C507D !important;
            border: 1px solid rgba(60, 80, 125, 0.2) !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .btn-secondary:hover, .btn-back:hover {
            background: #D9CBC2 !important;
            transform: translateY(-2px) !important;
            color: #112250 !important;
        }

        /* Danger/Delete Buttons */
        .btn-danger, .btn-delete, .btn-delete-custom {
            background: #ef4444 !important;
            color: white !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 500 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .btn-danger:hover, .btn-delete:hover, .btn-delete-custom:hover {
            background: #dc2626 !important;
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        }

        /* Interactive Form Controls */
        input[type="text"], input[type="password"], input[type="email"], input[type="number"], select, textarea {
            border: 1.5px solid rgba(60, 80, 125, 0.2) !important;
            border-radius: 12px !important;
            padding: 10px 14px !important;
            background-color: #ffffff !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            color: #112250 !important;
        }
        input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus, input[type="number"]:focus, select:focus, textarea:focus {
            outline: none !important;
            border-color: #E0C58F !important;
            box-shadow: 0 0 0 4px rgba(224, 181, 143, 0.25) !important;
            background-color: #ffffff !important;
        }

        /* Interactive Tables Hover effect */
        table tbody tr {
            transition: all 0.2s ease !important;
        }
        table tbody tr:hover {
            background-color: rgba(224, 181, 143, 0.04) !important;
            transform: scale(1.002);
        }

        /* btn-info specifically for Lihat Bukti */
        .btn-info {
            background: #3C507D !important;
            color: #ffffff !important;
            border: 1px solid rgba(224, 181, 143, 0.3) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 4px 12px rgba(60, 80, 125, 0.2) !important;
        }
        .btn-info:hover {
            background: #112250 !important;
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 16px rgba(17, 34, 80, 0.3) !important;
            color: #E0C58F !important;
        }

        /* Animated Badges */
        .badge-status, .badge-lunas, .badge-success, .badge-warning, .badge-danger, .badge-danger-custom {
            padding: 6px 14px !important;
            border-radius: 30px !important;
            font-weight: 600 !important;
            font-size: 11px !important;
            letter-spacing: 0.05em !important;
            text-transform: uppercase !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .badge-lunas, .badge-success {
            background: rgba(34, 197, 94, 0.1) !important;
            color: #22c55e !important;
            border: 1px solid rgba(34, 197, 94, 0.25) !important;
        }
        .badge-lunas:hover, .badge-success:hover {
            background: rgba(34, 197, 94, 0.2) !important;
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.15) !important;
            transform: scale(1.05);
        }
        .badge-warning {
            background: rgba(245, 158, 11, 0.1) !important;
            color: #f59e0b !important;
            border: 1px solid rgba(245, 158, 11, 0.25) !important;
        }
        .badge-warning:hover {
            background: rgba(245, 158, 11, 0.2) !important;
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.15) !important;
            transform: scale(1.05);
        }
        .badge-danger, .badge-danger-custom {
            background: rgba(239, 68, 68, 0.1) !important;
            color: #ef4444 !important;
            border: 1px solid rgba(239, 68, 68, 0.25) !important;
        }
        .badge-danger:hover, .badge-danger-custom:hover {
            background: rgba(239, 68, 68, 0.2) !important;
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.15) !important;
            transform: scale(1.05);
        }

        /* Modern Page Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card, .card-box, .welcome-box, .container-box {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        .card:nth-child(1), .card-box:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2), .card-box:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3), .card-box:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4), .card-box:nth-child(4) { animation-delay: 0.4s; }

        /* Premium Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F5F0E9;
        }
        ::-webkit-scrollbar-thumb {
            background: #3C507D;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #112250;
        }

    </style>
</head>
<body>

<div class="sidebar">
    <div style="text-align:center;margin-bottom:35px;">
        <img src="{{ asset('IMG/ImageLogo.png') }}" style="width: 95px;margin-bottom:10px;">
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

        <a href="{{ route('admin.pengajuan.index') }}" class="active">
            <span>Pengajuan Beasiswa</span>
            @if(isset($notifBeasiswaAdmin) && $notifBeasiswaAdmin > 0)
                <span class="badge-notif-sidebar">{{ $notifBeasiswaAdmin }}</span>
            @endif
        </a>

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
                    <th>PERIODE</th>
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
                        <td>
                            <strong>{{ $item->nama }}</strong>
                            <div class="mt-1" style="font-size: 11px; line-height: 1.4; color: #475569; background: #f8fafc; padding: 4px 8px; border-radius: 6px; border: 1px solid #e2e8f0;">
                                Indo: <span style="{{ $item->nilai_bindo < 75 ? 'color: #dc2626; font-weight: 700;' : '' }}">{{ $item->nilai_bindo }}</span> |
                                Ing: <span style="{{ $item->nilai_bing < 75 ? 'color: #dc2626; font-weight: 700;' : '' }}">{{ $item->nilai_bing }}</span> |
                                MTK: <span style="{{ $item->nilai_mtk < 75 ? 'color: #dc2626; font-weight: 700;' : '' }}">{{ $item->nilai_mtk }}</span> |
                                PKN: <span style="{{ $item->nilai_pkn < 75 ? 'color: #dc2626; font-weight: 700;' : '' }}">{{ $item->nilai_pkn }}</span> |
                                IPA: <span style="{{ $item->nilai_ipa < 75 ? 'color: #dc2626; font-weight: 700;' : '' }}">{{ $item->nilai_ipa }}</span> |
                                IPS: <span style="{{ $item->nilai_ips < 75 ? 'color: #dc2626; font-weight: 700;' : '' }}">{{ $item->nilai_ips }}</span>
                            </div>
                        </td>
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

                        <td>
                            @php
                                $bulan = [
                                    1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',
                                    5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',
                                    9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
                                ];
                            @endphp

                            <small class="text-success fw-semibold">
                                {{ $bulan[$item->bulan_buka] ?? '-' }}
                                {{ $item->tahun_buka }}
                            </small>

                            <br>

                            <small class="text-muted">
                                s/d
                            </small>

                            <br>

                            <small class="text-danger fw-semibold">
                                {{ $bulan[$item->bulan_tutup] ?? '-' }}
                                {{ $item->tahun_tutup }}
                            </small>
                        </td>

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
                        <td colspan="13" class="text-center py-4 text-muted">
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
