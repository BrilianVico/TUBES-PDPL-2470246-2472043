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
            --primary:#176d4c;
            --primary-dark:#0f5132;
            --bg:#f8fafc;
            --card:#ffffff;
            --text:#0f172a;
            --muted:#64748b;
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

        .sidebar{
            width:280px;
            background:linear-gradient(180deg,#176d4c,#0f5132);
            color:white;
            padding:30px 20px;
            position:fixed;
            top:0;
            left:0;
            bottom:0;
            box-shadow:10px 0 40px rgba(0,0,0,.12);
        }

        .brand{
            text-align:center;
            padding-bottom:25px;
            border-bottom:1px solid rgba(255,255,255,.1);
            margin-bottom:30px;
        }

        .brand img{
            width:70px;
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

        .menu a{
            display:block;
            color:rgba(255,255,255,.85);
            text-decoration:none;
            padding:14px 18px;
            border-radius:14px;
            margin-bottom:10px;
            transition:.3s;
            font-weight:500;
        }

        .menu a:hover,
        .menu a.active{
            background:rgba(255,255,255,.12);
            color:white;
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

            .sidebar{
                display:none;
            }

            .main{
                margin-left:0;
                padding:20px;
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
            <a href="{{ route('dashboard.ortu') }}">
                Dashboard
            </a>

            <a href="{{ route('ortu.tagihan.index') }}">
                Bayar Tagihan
            </a>

            <!-- GANTI '#' MENJADI ROUTE DI BAWAH INI -->
            <a href="{{ route('ortu.riwayat.index') }}" class="{{ Request::routeIs('ortu.riwayat.index') ? 'active' : '' }}">
                Riwayat Pembayaran
            </a>

            <a href="{{ route('ortu.beasiswa.create') }}" class="{{ Request::routeIs('ortu.beasiswa.create') ? 'active' : '' }}">
                Daftar Beasiswa
            </a>

            <a href="{{ route('ortu.change-password') }}">
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
                    $total = $item->nominal - $potongan;
                @endphp

                <div class="col-lg-6 mb-4">

                    <div class="tagihan-card">

                        <div class="d-flex justify-content-between mb-3">

                            <h5 class="fw-bold">
                                {{ $item->jenis_tagihan }}
                            </h5>

                            @if($item->status == 'LUNAS')
                                <span class="badge bg-success">
                                    LUNAS
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    BELUM BAYAR
                                </span>
                            @endif

                        </div>

                        <p>
                            <strong>Nama Siswa :</strong>
                            {{ $item->nama_siswa }}
                        </p>

                        <p>
                            <strong>NIS :</strong>
                            {{ $item->nis }}
                        </p>

                        <p>
                            <strong>Periode :</strong>
                            {{ $item->bulan }} {{ $item->tahun }}
                        </p>

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Nominal Awal</span>

                            <strong>
                                Rp {{ number_format($item->nominal,0,',','.') }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between mb-2">

                            <span>Potongan Beasiswa</span>

                            <strong class="text-success">
                                - Rp {{ number_format($potongan,0,',','.') }}
                            </strong>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center">

                            <span>Total Bayar</span>

                            <span class="total">
                                Rp {{ number_format($total,0,',','.') }}
                            </span>

                        </div>

                        @if($item->status != 'LUNAS')

                            <a href="{{ route('ortu.tagihan.bayar',$item->id_tagihan) }}"
                               class="btn btn-bayar w-100 mt-4">

                                Bayar Sekarang

                            </a>

                        @endif

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-info rounded-4">
                        Tidak ada tagihan.
                    </div>

                </div>

            @endforelse

        </div>

    </main>

</div>

</body>
</html>

