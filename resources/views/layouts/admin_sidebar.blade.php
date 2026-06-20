<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px !important;
        height: 100vh;
        background: linear-gradient(180deg, #112250, #08122d) !important;
        color: white;
        padding: 35px 24px;
        box-shadow: 5px 0 35px rgba(17, 34, 80, 0.15);
        border-right: 1px solid rgba(224, 181, 143, 0.1);
        z-index: 100;
    }

    .sidebar .brand {
        text-align: center;
        padding-bottom: 25px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        margin-bottom: 30px;
    }

    .sidebar .brand img {
        width: 95px;
        margin-bottom: 10px;
    }

    .sidebar .brand h2 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .sidebar .brand p {
        font-size: 12px;
        opacity: 0.75;
        margin: 0;
    }

    .sidebar .menu a {
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

    .sidebar .menu a:hover,
    .sidebar .menu a.active {
        background: rgba(224, 181, 143, 0.12) !important;
        color: #E0C58F !important;
        border-color: rgba(224, 181, 143, 0.25);
        transform: translateX(4px);
    }

    .sidebar .logout-btn {
        margin-top: 30px;
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 14px;
        background: rgba(239, 68, 68, 0.15);
        color: #fecaca;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }
    .sidebar .logout-btn:hover {
        background: rgba(239, 68, 68, 0.3);
        color: #ffffff;
    }

    /* Force adjust main content margin */
    .content, .main {
        margin-left: 280px !important;
    }
</style>

<aside class="sidebar">
    <div class="brand">
        <img src="{{ asset('IMG/ImageLogo.png') }}" alt="Logo Sunodia">
        <h2>Sunodia</h2>
        <p>Portal Admin</p>
    </div>

    <nav class="menu">
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.data-siswa') }}"
           class="{{ request()->routeIs('admin.data-siswa') ? 'active' : '' }}">
            <span>Data Siswa</span>
        </a>

        <a href="{{ route('admin.tagihan.index') }}"
           class="{{ request()->routeIs('admin.tagihan.*') ? 'active' : '' }}">
            <span>Tagihan</span>
        </a>

        <a href="{{ route('admin.pembayaran.index') }}"
           class="{{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <span>Pembayaran</span>
            @if(isset($notifPembayaranAdmin) && $notifPembayaranAdmin > 0)
                <span style="background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifPembayaranAdmin }}</span>
            @endif
        </a>

        <a href="{{ route('admin.beasiswa.index') }}"
           class="{{ request()->routeIs('admin.beasiswa.*') ? 'active' : '' }}">
            <span>Beasiswa</span>
        </a>

        <a href="{{ route('admin.pengumuman.index') }}"
           class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
            <span>Pengumuman</span>
        </a>

        <a href="{{ route('admin.pengajuan.index') }}" class="{{ request()->routeIs('admin.pengajuan.*') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <span>Pengajuan Beasiswa</span>
            @if(isset($notifBeasiswaAdmin) && $notifBeasiswaAdmin > 0)
                <span style="background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifBeasiswaAdmin }}</span>
            @endif
        </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</aside>
