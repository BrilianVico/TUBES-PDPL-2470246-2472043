<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Tagihan | Sunodia Academy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        :root{
            --primary:#3C507D;
            --primary-dark:#112250;
            --bg:#F5F0E9;
            --card:#ffffff;
            --text:#112250;
            --muted: #5a6e9c;
            --shadow:0 20px 40px rgba(15,23,42,.08);
            --radius:24px;
        }

        body{
            font-family:'Poppins',sans-serif;
            background:var(--bg);
            color:var(--text);
        }

        .layout{
            display:flex;
            min-height:100vh;
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

        .brand{
            text-align:center;
            padding-bottom:25px;
            border-bottom:1px solid rgba(255,255,255,.1);
            margin-bottom:30px;
        }

        .brand img{
            width: 95px;
            margin-bottom:10px;
        }

        .brand h2{
            font-size:20px;
            font-weight:700;
            margin-bottom:4px;
        }

        .brand p{
            font-size:12px;
            opacity:.75;
            margin:0;
        }

        .menu a {
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

        .menu a:hover, .menu a.active {
            background: rgba(224, 181, 143, 0.12) !important;
            color: #E0C58F !important;
            border-color: rgba(224, 181, 143, 0.25);
            transform: translateX(4px);
        }

        .logout-btn{
            margin-top:30px;
            width:100%;
            padding:14px;
            border:none;
            border-radius:14px;
            background:rgba(239,68,68,.15);
            color:#fecaca;
            font-weight:600;
            cursor:pointer;
        }

        .main{
            flex:1;
            margin-left:280px;
            min-height:100vh;
            padding:40px;
        }

        .topbar{
            margin-bottom:24px;
        }

        .topbar h1{
            font-size:32px;
            font-weight:800;
            margin-bottom:6px;
        }

        .topbar p{
            color:var(--muted);
            margin:0;
        }

        .tagihan-card{
            background:white;
            border-radius:24px;
            padding:25px;
            box-shadow:var(--shadow);
            height:100%;
            transition:.3s;
        }

        .tagihan-card:hover{
            transform:translateY(-4px);
        }

        .total{
            color:var(--primary);
            font-size:26px;
            font-weight:800;
        }

        .btn-bayar{
            background:var(--primary);
            color:white;
            border:none;
            border-radius:12px;
            padding:12px;
            font-weight:600;
        }

        .btn-bayar:hover{
            background:var(--primary-dark);
            color:white;
        }

        @media(max-width:992px){

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

            .main{
                margin-left:0;
                padding:20px;
            }

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
            color: #E0C58F !important; /* Quicksand color on text hover */
        }
        .btn-primary-custom:active, .btn-add:active, .btn-submit:active, .btn-login:active, .btn-register:active, .btn-bayar:active, .btn-detail:active, .btn-save:active, .btn-primary:active {
            transform: translateY(0) scale(0.98) !important;
        }

        /* Success & Other Accent Buttons */
        .btn-success, .btn-edit, .btn-edit-custom {
            background: #E0C58F !important; /* Quicksand */
            color: #112250 !important; /* Royal Blue text */
            border: 1px solid rgba(17, 34, 80, 0.1) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 4px 12px rgba(224, 181, 143, 0.2) !important;
        }
        .btn-success:hover, .btn-edit:hover, .btn-edit-custom:hover {
            background: #D9CBC2 !important; /* Shellstone */
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 16px rgba(224, 181, 143, 0.35) !important;
            color: #112250 !important;
        }

        /* Secondary Back Buttons */
        .btn-secondary, .btn-back {
            background: #F5F0E9 !important; /* Swan Wing */
            color: #3C507D !important; /* Sapphire */
            border: 1px solid rgba(60, 80, 125, 0.2) !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .btn-secondary:hover, .btn-back:hover {
            background: #D9CBC2 !important; /* Shellstone */
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
            border-color: #E0C58F !important; /* Quicksand */
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
            background: #3C507D !important; /* Sapphire */
            color: #ffffff !important;
            border: 1px solid rgba(224, 181, 143, 0.3) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 4px 12px rgba(60, 80, 125, 0.2) !important;
        }
        .btn-info:hover {
            background: #112250 !important; /* Royal Blue */
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 16px rgba(17, 34, 80, 0.3) !important;
            color: #E0C58F !important; /* Quicksand text color on hover */
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
            background: #F5F0E9; /* Swan Wing */
        }
        ::-webkit-scrollbar-thumb {
            background: #3C507D; /* Sapphire */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #112250; /* Royal Blue */
        }
    
</style>
</head>
<body>

<div class="layout">

    <aside class="sidebar">

        <div class="brand">
            <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo Sunodia">
            <h2>Sunodia</h2>
            <p>Portal Wali Murid</p>
        </div>

        <nav class="menu">
            <a href="{{ route('dashboard.ortu') }}" class="{{ request()->routeIs('dashboard.ortu') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('ortu.tagihan.index') }}" class="active" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span>Bayar Tagihan</span>
                <span id="badge-tagihan-ortu" style="{{ isset($notifTagihanOrtu) && $notifTagihanOrtu > 0 ? '' : 'display: none;' }} background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifTagihanOrtu ?? '' }}</span>
            </a>

            <a href="{{ route('ortu.riwayat.index') }}" class="{{ Request::routeIs('ortu.riwayat.index') ? 'active' : '' }}">
                Riwayat Pembayaran
            </a>

            <a href="{{ route('ortu.beasiswa.create') }}" class="{{ Request::routeIs('ortu.beasiswa.create') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span>Daftar Beasiswa</span>
                <span id="badge-beasiswa-ortu" style="{{ isset($notifBeasiswaOrtu) && $notifBeasiswaOrtu > 0 ? '' : 'display: none;' }} background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifBeasiswaOrtu ?? '' }}</span>
            </a>

            <a href="{{ route('ortu.change-password') }}" class="{{ Request::routeIs('ortu.change-password') ? 'active' : '' }}">
                Ubah Password
            </a>
        </nav>

        <form method="POST" action="{{ route('logout.ortu') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>

    </aside>

    <main class="main">

        <div class="topbar">
            <h1>Bayar Tagihan</h1>
            <p>Daftar tagihan siswa yang perlu dibayarkan.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($tagihan as $item)
                @php
                    $potongan = $item->potongan_beasiswa ?? 0;
                    $total = ($item->nominal ?? 0) - $potongan;
                @endphp

                <div class="col-lg-6 mb-4">
                    <div class="tagihan-card" style="{{ $item->has_unpaid_previous ? 'border: 2px solid #ef4444; box-shadow: 0 0 15px rgba(239, 68, 68, 0.15);' : '' }}">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="fw-bold">{{ $item->jenis_tagihan ?? 'Tagihan' }}</h5>

                            @if($item->status == 'LUNAS')
                                <span class="badge bg-success">LUNAS</span>
                            @elseif($item->status == 'DITOLAK')
                                <span class="badge bg-danger">DITOLAK ADMIN</span>
                            @else
                                <span class="badge {{ $item->has_unpaid_previous ? 'bg-danger' : 'bg-warning' }}">BELUM BAYAR</span>
                            @endif
                        </div>

                        @if($item->has_unpaid_previous)
                            <div style="background-color: #ef4444; border: 1.5px solid #dc2626; color: #ffffff; padding: 10px 14px; border-radius: 12px; font-size: 13px; font-weight: 700; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);">
                                <i class="fas fa-exclamation-triangle"></i> Peringatan: Belum Bayar di Bulan Sebelumnya!
                            </div>
                        @endif

                        <p><strong>Nama Siswa :</strong> {{ $item->nama_siswa ?? '-' }}</p>
                        <p><strong>NIS :</strong> {{ $item->nis ?? '-' }}</p>
                        <p><strong>Periode :</strong> {{ $item->bulan ?? '-' }} {{ $item->tahun ?? '' }}</p>

                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Nominal Awal</span>
                            <strong>Rp {{ number_format($item->nominal ?? 0, 0, ',', '.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Potongan Beasiswa</span>
                            <strong class="text-success">- Rp {{ number_format($potongan, 0, ',', '.') }}</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Bayar</span>
                            <span class="total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        @if($item->status != 'LUNAS')
                            <a href="{{ route('ortu.tagihan.bayar', $item->id_tagihan ?? 0) }}"
                               class="btn btn-bayar w-100 mt-4 {{ $item->status == 'DITOLAK' ? 'btn-danger' : '' }}">
                                {{ $item->status == 'DITOLAK' ? 'Bayar Ulang' : 'Bayar Sekarang' }}
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info rounded-4">Tidak ada tagihan.</div>
                </div>
            @endforelse
        </div>
    </main>
</div>

<script>
    function fetchLiveNotifications() {
        fetch('{{ route("ortu.notifications.count") }}')
            .then(res => res.json())
            .then(data => {
                const badgeTagihan = document.getElementById('badge-tagihan-ortu');
                if (badgeTagihan) {
                    if (data.notifTagihanOrtu > 0) {
                        badgeTagihan.innerText = data.notifTagihanOrtu;
                        badgeTagihan.style.display = 'inline';
                    } else {
                        badgeTagihan.style.display = 'none';
                    }
                }
                const badgeBeasiswa = document.getElementById('badge-beasiswa-ortu');
                if (badgeBeasiswa) {
                    if (data.notifBeasiswaOrtu > 0) {
                        badgeBeasiswa.innerText = data.notifBeasiswaOrtu;
                        badgeBeasiswa.style.display = 'inline';
                    } else {
                        badgeBeasiswa.style.display = 'none';
                    }
                }
            })
            .catch(err => console.error("Error fetching live notifications: ", err));
    }
    
    // Poll every 3 seconds
    setInterval(fetchLiveNotifications, 3000);
    // Initial fetch on load
    document.addEventListener('DOMContentLoaded', fetchLiveNotifications);
</script>

</body>
</html>
