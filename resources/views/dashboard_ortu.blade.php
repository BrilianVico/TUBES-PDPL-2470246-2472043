<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua - SMP Sunodia</title>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #3C507D;
            --primary-dark: #112250;
            --primary-light: #5a6e9c;
            --bg: #F5F0E9;
            --card: #ffffff;
            --text: #112250;
            --muted: #5a6e9c;
            --danger: #ef4444;
            --accent: #E0C58F;
            --shadow-sm: 0 4px 6px rgba(17, 34, 80, 0.03);
            --shadow-md: 0 10px 25px rgba(17, 34, 80, 0.05);
            --shadow-lg: 0 20px 40px rgba(17, 34, 80, 0.08);
            --radius-sm: 12px;
            --radius-md: 20px;
            --radius-lg: 28px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, #112250, #08122d);
            color: white;
            padding: 35px 24px;
            box-shadow: 5px 0 35px rgba(17, 34, 80, 0.15);
            border-right: 1px solid rgba(224, 181, 143, 0.1);
            z-index: 100;
        }

        .brand {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 30px;
        }

        .brand img {
            width: 95px;
            margin-bottom: 10px;
        }

        .brand h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .brand p {
            font-size: 12px;
            opacity: 0.75;
            margin: 0;
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

        .menu a:hover,
        .menu a.active {
            background: rgba(224, 181, 143, 0.12) !important;
            color: #E0C58F !important;
            border-color: rgba(224, 181, 143, 0.25);
            transform: translateX(4px);
        }

        .logout-btn {
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
        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.3);
            color: white;
        }

        .main {
            flex: 1;
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .topbar {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            padding: 24px 35px;
            border-radius: var(--radius-md);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar h1 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .topbar p {
            color: var(--muted);
            font-size: 14px;
            margin-top: 4px;
            font-weight: 500;
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 14px;
            background: white;
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(17, 34, 80, 0.05);
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3C507D, #112250);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
        }

        .profile-box small {
            color: var(--muted);
            display: block;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .profile-box strong {
            font-size: 14px;
            color: var(--primary-dark);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }

        .card {
            background: var(--card);
            border-radius: var(--radius-md);
            padding: 28px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(224, 181, 143, 0.15);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(224, 181, 143, 0.5);
        }

        .stat-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 38px;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(224, 181, 143, 0.2);
            padding-bottom: 10px;
        }

        .child-item {
            padding: 20px;
            border: 1px solid rgba(17, 34, 80, 0.08);
            border-radius: var(--radius-sm);
            margin-bottom: 15px;
            background: #fdfdfd;
            transition: 0.3s;
        }

        .child-item:hover {
            border-color: var(--accent);
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .child-item h4 {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 6px;
        }

        .child-item p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
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
            <a href="{{ route('dashboard.ortu') }}" class="{{ request()->routeIs('dashboard.ortu') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span>Dashboard</span>
                <span id="badge-pengumuman-ortu" style="{{ isset($notifPengumumanOrtu) && $notifPengumumanOrtu > 0 ? '' : 'display: none;' }} background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifPengumumanOrtu ?? '' }}</span>
            </a>

            <a href="{{ route('ortu.tagihan.index') }}" class="{{ request()->routeIs('ortu.tagihan.index') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span>Bayar Tagihan</span>
                <span id="badge-tagihan-ortu" style="{{ isset($notifTagihanOrtu) && $notifTagihanOrtu > 0 ? '' : 'display: none;' }} background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifTagihanOrtu ?? '' }}</span>
            </a>

            <a href="{{ route('ortu.riwayat.index') }}" class="{{ request()->routeIs('ortu.riwayat.index') ? 'active' : '' }}">
                Riwayat Pembayaran
            </a>

            <a href="{{ route('ortu.beasiswa.create') }}" class="{{ request()->routeIs('ortu.beasiswa.create') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span>Daftar Beasiswa</span>
                <span id="badge-beasiswa-ortu" style="{{ isset($notifBeasiswaOrtu) && $notifBeasiswaOrtu > 0 ? '' : 'display: none;' }} background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">{{ $notifBeasiswaOrtu ?? '' }}</span>
            </a>

            <a href="{{ route('ortu.change-password') }}" class="{{ request()->routeIs('ortu.change-password') ? 'active' : '' }}">
                Ubah Password
            </a>
        </nav>

        <form method="POST" action="{{ route('logout.ortu') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h1>Halo, {{ session('nama_wali') }}</h1>
                <p>{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>

            <div class="profile-box">
                <div class="avatar">
                    {{ strtoupper(substr(session('nama_wali', 'W'), 0, 1)) }}
                </div>
                <div>
                    <small>Wali Murid</small>
                    <strong>{{ session('username_wali') }}</strong>
                </div>
            </div>
        </div>

        {{-- Statistik --}}
        <section class="stats">
            <div class="card">
                <div class="stat-label">Jumlah Anak</div>
                <div class="stat-value">{{ $anakAnak->count() }}</div>
            </div>

            <div class="card">
                <div class="stat-label">Pengumuman Aktif</div>
                <div class="stat-value" style="color: #176d4c;">
                    {{ $pengumuman->count() }}
                </div>
            </div>
        </section>

        {{-- Konten Utama --}}
        <section class="content-grid">
            {{-- Data Anak --}}
            <div class="card">
                <h3 class="section-title">👨‍🎓 Data Anak</h3>

                @forelse($anakAnak as $anak)
                    <div class="child-item">
                        <h4>{{ $anak->nama }}</h4>
                        <p>NIS: {{ $anak->nis }} • Kelas {{ $anak->nama_kelas }}</p>
                    </div>
                @empty
                    <p style="color: #64748b; padding: 10px;">Belum ada data anak terdaftar.</p>
                @endforelse
            </div>

            {{-- Pengumuman --}}
            <div class="card" id="announcements-card-wrapper">
                <h3 class="section-title">📢 Pengumuman Sekolah</h3>

                <div id="announcements-container">
                    @forelse($pengumuman as $item)
                        <div class="child-item" id="pengumuman-{{ $item->id_pengumuman }}" style="position: relative; transition: all 0.3s ease; cursor: pointer;" onclick="dismissAnnouncement({{ $item->id_pengumuman }})" title="Klik untuk tandai sudah dibaca">
                            <button style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 18px; color: #ef4444; cursor: pointer; opacity: 0.6; transition: 0.2s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.6" title="Tandai sudah dibaca">
                                <i class="fas fa-times-circle"></i>
                            </button>
                            <h4 style="padding-right: 25px;">{{ $item->judul }}</h4>

                            <p style="margin-top: 6px; padding-right: 25px;">
                                {{ $item->isi }}
                            </p>

                            <p style="font-size: 12px; margin-top: 8px; color: #94a3b8;">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    @empty
                        <p style="color: #64748b;" id="no-announcements-placeholder">
                            Belum ada pengumuman.
                        </p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>


</div>

<script>
    function dismissAnnouncement(id) {
        if (!confirm('Tandai pengumuman ini sebagai sudah dibaca?')) return;

        fetch(`/ortu/pengumuman/${id}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const el = document.getElementById(`pengumuman-${id}`);
                if (el) {
                    el.style.opacity = '0';
                    el.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        el.remove();
                        // Refresh count and list immediately
                        fetchLiveNotifications();
                        fetchLiveAnnouncements();
                    }, 300);
                }
            }
        })
        .catch(err => console.error("Error dismissing announcement:", err));
    }

    function fetchLiveAnnouncements() {
        fetch('{{ route("ortu.announcements.live") }}')
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('announcements-container');
                if (!container) return;

                if (!data.announcements || data.announcements.length === 0) {
                    container.innerHTML = `<p style="color: #64748b;" id="no-announcements-placeholder">Belum ada pengumuman.</p>`;
                    return;
                }

                // Get current IDs in DOM
                const existingElements = container.querySelectorAll('.child-item');
                const existingIds = Array.from(existingElements).map(el => {
                    const match = el.id.match(/pengumuman-(\d+)/);
                    return match ? parseInt(match[1]) : null;
                }).filter(id => id !== null);

                const newIds = data.announcements.map(a => a.id_pengumuman);

                // 1. Remove elements that are no longer active/present in response
                existingElements.forEach(el => {
                    const match = el.id.match(/pengumuman-(\d+)/);
                    const id = match ? parseInt(match[1]) : null;
                    if (id !== null && !newIds.includes(id)) {
                        el.style.opacity = '0';
                        el.style.transform = 'scale(0.9)';
                        setTimeout(() => el.remove(), 300);
                    }
                });

                // 2. Add or update items
                data.announcements.forEach(a => {
                    let itemEl = document.getElementById(`pengumuman-${a.id_pengumuman}`);
                    if (!itemEl) {
                        // Create new announcement element
                        itemEl = document.createElement('div');
                        itemEl.className = 'child-item';
                        itemEl.id = `pengumuman-${a.id_pengumuman}`;
                        itemEl.style.position = 'relative';
                        itemEl.style.transition = 'all 0.3s ease';
                        itemEl.style.cursor = 'pointer';
                        itemEl.style.opacity = '0';
                        itemEl.style.transform = 'translateY(10px)';
                        itemEl.title = 'Klik untuk tandai sudah dibaca';
                        itemEl.onclick = () => dismissAnnouncement(a.id_pengumuman);

                        // Prepend or append depending on sorting (descending order)
                        const placeholder = document.getElementById('no-announcements-placeholder');
                        if (placeholder) placeholder.remove();

                        container.insertBefore(itemEl, container.firstChild);
                        // Trigger fade-in
                        setTimeout(() => {
                            itemEl.style.opacity = '1';
                            itemEl.style.transform = 'translateY(0)';
                        }, 50);
                    }

                    // Set content
                    itemEl.innerHTML = `
                        <button style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 18px; color: #ef4444; cursor: pointer; opacity: 0.6; transition: 0.2s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.6" title="Tandai sudah dibaca">
                            <i class="fas fa-times-circle"></i>
                        </button>
                        <h4 style="padding-right: 25px;">${a.judul}</h4>
                        <p style="margin-top: 6px; padding-right: 25px;">${a.isi}</p>
                        <p style="font-size: 12px; margin-top: 8px; color: #94a3b8;">${a.tanggal_formatted}</p>
                    `;
                });
            })
            .catch(err => console.error("Error fetching live announcements: ", err));
    }

    function fetchLiveNotifications() {
        fetch('{{ route("ortu.notifications.count") }}')
            .then(res => res.json())
            .then(data => {
                const badgePengumuman = document.getElementById('badge-pengumuman-ortu');
                if (badgePengumuman) {
                    if (data.notifPengumumanOrtu > 0) {
                        badgePengumuman.innerText = data.notifPengumumanOrtu;
                        badgePengumuman.style.display = 'inline';
                    } else {
                        badgePengumuman.style.display = 'none';
                    }
                }
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
    setInterval(() => {
        fetchLiveNotifications();
        fetchLiveAnnouncements();
    }, 3000);
    // Initial fetch on load
    document.addEventListener('DOMContentLoaded', () => {
        fetchLiveNotifications();
        fetchLiveAnnouncements();
    });
</script>

</body>
</html>
