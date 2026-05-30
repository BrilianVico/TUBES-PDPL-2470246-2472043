    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pengajuan Beasiswa - SMP Sunodia</title>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            *{
                margin:0;
                padding:0;
                box-sizing:border-box;
            }

            body{
                font-family:'Poppins',sans-serif;
                min-height:100vh;
                background:url('{{ asset('IMG/GambarSekolah.png') }}') center center / cover no-repeat fixed;
                display:flex;
                justify-content:center;
                align-items:center;
                padding:30px;
                color:white;
                position:relative;
            }

            body::before{
                content:'';
                position:fixed;
                inset:0;
                background:
                    radial-gradient(circle at top right, rgba(16,185,129,.18), transparent 35%),
                    radial-gradient(circle at bottom left, rgba(59,130,246,.12), transparent 35%),
                    rgba(2,6,23,.78);
                backdrop-filter:blur(10px);
                z-index:-1;
            }

            .card{
                width:100%;
                max-width:900px;
                padding:40px;
                border-radius:30px;
                background:rgba(15,23,42,.82);
                border:1px solid rgba(255,255,255,.08);
                backdrop-filter:blur(16px);
                box-shadow:0 30px 80px rgba(0,0,0,.45);
            }

            .badge{
                display:inline-block;
                padding:8px 18px;
                border-radius:999px;
                background:rgba(16,185,129,.12);
                border:1px solid rgba(16,185,129,.35);
                color:#a7f3d0;
                font-size:.8rem;
                font-weight:600;
                margin-bottom:18px;
            }

            h1{
                font-size:2rem;
                font-weight:800;
                margin-bottom:10px;
            }

            .desc{
                color:rgba(255,255,255,.75);
                margin-bottom:30px;
                line-height:1.8;
            }

            .row{
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:18px;
            }

            .form-group{
                margin-bottom:18px;
            }

            .form-label{
                display:block;
                margin-bottom:8px;
                font-size:.9rem;
                font-weight:500;
            }

            .form-control {
                width: 100%;
                padding: 14px 16px;
                border-radius: 14px;
                border: 1px solid rgba(255,255,255,.10);
                background: rgba(255,255,255,.06);
                color: white;
                outline: none;
                font-size: 15px;
                transition: .3s;
            }

            .form-control:focus {
                border-color: #10b981;
                box-shadow: 0 0 0 4px rgba(16,185,129,.15);
            }

            select.form-control {
                cursor: pointer;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;

                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='white' viewBox='0 0 16 16'%3E%3Cpath d='M1.5 5.5l6 6 6-6'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 16px center;
                background-size: 14px;
                padding-right: 45px;
            }

            select.form-control option {
                background: #1e293b;
                color: white;
                padding: 12px;
            }

            .btn-submit{
                width:100%;
                padding:14px;
                border:none;
                border-radius:14px;
                background:linear-gradient(135deg,#10b981,#059669);
                color:white;
                font-size:.95rem;
                font-weight:600;
                cursor:pointer;
                margin-top:10px;
            }

            .btn-submit:hover{
                transform:translateY(-2px);
            }

            .alert-success{
                padding:12px;
                border-radius:12px;
                background:rgba(16,185,129,.15);
                border:1px solid rgba(16,185,129,.35);
                margin-bottom:20px;
            }

            .back-link{
                display:block;
                text-align:center;
                margin-top:20px;
                color:rgba(255,255,255,.7);
                text-decoration:none;
            }

            .back-link:hover{
                color:white;
            }

            @media(max-width:768px){
                .row{
                    grid-template-columns:1fr;
                }

                .card{
                    padding:25px;
                }
            }
        </style>
    </head>
    <script>
        function isiDataSiswa()
        {
            const select = document.getElementById('id_siswa');
            const option = select.options[select.selectedIndex];

            document.getElementById('nis').value =
                option.dataset.nis || '';

            document.getElementById('nama').value =
                option.dataset.nama || '';

            document.getElementById('kelas').value =
                option.dataset.kelas || '';

            document.getElementById('hidden_nis').value =
                option.dataset.nis || '';

            document.getElementById('hidden_nama').value =
                option.dataset.nama || '';

            document.getElementById('hidden_kelas').value =
                option.dataset.kelas || '';
        }
    </script>
    <body>

    <div class="card">

        <div class="badge">
            Pengajuan Beasiswa
        </div>

        <h1>Form Pengajuan Beasiswa</h1>

        <p class="desc">
            Silakan isi data akademik siswa dengan lengkap. Data akan diverifikasi oleh pihak sekolah sebelum pengajuan beasiswa diproses.
        </p>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('ortu.beasiswa.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Pilih Siswa</label>

                <select
                    name="id_siswa"
                    id="id_siswa"
                    class="form-control"
                    onchange="isiDataSiswa()"
                    required
                >
                    <option value="">Pilih Siswa</option>

                    @foreach($siswa as $item)
                        <option
                            value="{{ $item->id_siswa }}"
                            data-nis="{{ $item->nis }}"
                            data-nama="{{ $item->nama }}"
                            data-kelas="{{ $item->kelas }}"
                        >
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Jenis Beasiswa</label>

                <select
                    name="id_beasiswa"
                    class="form-control"
                    required
                >
                    <option value="">Pilih Jenis Beasiswa</option>

                    @foreach($beasiswa as $item)
                        <option value="{{ $item->id_beasiswa }}">
                            {{ $item->nama_beasiswa }}
                            {{ $item->persentase_potongan }}%
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="row">

                <div class="form-group">
                    <label class="form-label">NIS</label>

                    <input
                        type="text"
                        id="nis"
                        class="form-control"
                        readonly
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Siswa</label>

                    <input
                        type="text"
                        id="nama"
                        class="form-control"
                        readonly
                    >
                </div>

            </div>

            <div class="form-group">
                <label class="form-label">Kelas</label>

                <input
                    type="text"
                    id="kelas"
                    class="form-control"
                    readonly
                >
            </div>

            <input type="hidden" name="nis" id="hidden_nis">
            <input type="hidden" name="nama" id="hidden_nama">
            <input type="hidden" name="kelas" id="hidden_kelas">

            <div class="row">
                <div class="form-group">
                    <label class="form-label">Bahasa Indonesia</label>
                    <input type="number" name="nilai_bindo" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Bahasa Inggris</label>
                    <input type="number" name="nilai_bing" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Matematika</label>
                    <input type="number" name="nilai_mtk" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">PKN</label>
                    <input type="number" name="nilai_pkn" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">IPA</label>
                    <input type="number" name="nilai_ipa" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">IPS</label>
                    <input type="number" name="nilai_ips" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Ajukan Beasiswa
            </button>

        </form>

        <a href="{{ route('dashboard.ortu') }}" class="back-link">
            Kembali ke Dashboard
        </a>

    </div>

    </body>
    </html>
