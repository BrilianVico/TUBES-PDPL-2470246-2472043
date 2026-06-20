<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Tagihan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#F5F0E9;
            font-family:'Poppins',sans-serif;
        }

        .container-box{
            max-width:900px;
            margin:40px auto;
        }

        .card-custom{
            border:none;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }

        .header{
            background:linear-gradient(135deg,#3C507D,#112250);
            color:white;
            padding:25px;
            border-radius:20px 20px 0 0;
        }

        .qr-box{
            text-align:center;
            padding:20px;
            border:2px dashed #ddd;
            border-radius:15px;
            margin-bottom:20px;
        }

        .btn-submit{
            background:#3C507D;
            border:none;
            border-radius:12px;
            padding:12px;
            font-weight:600;
        }

        .btn-submit:hover{
            background:#112250;
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

<div class="container-box">

    <div class="card card-custom">

        <div class="header">
            {{-- status DITOLAK --}}
            @if($tagihan->status == 'DITOLAK')
                <div class="alert alert-danger mb-4">
                    <strong>Status: Ditolak Admin</strong>
                    <p class="mb-0">Mohon periksa kembali bukti transfer atau data pembayaran Anda. Silakan upload ulang bukti yang benar.</p>
                </div>
            @endif
            <h3>Bayar Tagihan</h3>
            <p class="mb-0">
                Upload bukti transfer pembayaran tagihan.
            </p>
        </div>

        <div class="card-body p-4">

            <div class="mb-4">
                <h5>{{ $tagihan->jenis_tagihan }}</h5>

                <table class="table">
                    <tr>
                        <th width="200">Nama Siswa</th>
                        <td>{{ $tagihan->nama_siswa }}</td>
                    </tr>

                    <tr>
                        <th>NIS</th>
                        <td>{{ $tagihan->nis }}</td>
                    </tr>

                    <tr>
                        <th>Periode</th>
                        <td>{{ $tagihan->bulan }} {{ $tagihan->tahun }}</td>
                    </tr>

                    @php
                        $potongan = $tagihan->potongan_beasiswa ?? 0;
                        $totalBayar = $tagihan->nominal - $potongan;
                    @endphp

                    <tr>
                        <th>Nominal Awal</th>
                        <td>
                            Rp {{ number_format($tagihan->nominal,0,',','.') }}
                        </td>
                    </tr>

                    <tr>
                        <th>Potongan Beasiswa</th>
                        <td class="text-success">
                            - Rp {{ number_format($potongan,0,',','.') }}
                        </td>
                    </tr>

                    <tr>
                        <th>Total Bayar</th>
                        <td>
                            <strong class="text-success">
                                Rp {{ number_format($totalBayar,0,',','.') }}
                            </strong>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="qr-box">

                <h5 class="mb-3">Scan QR Pembayaran</h5>

                {{-- Ganti dengan QR sekolah --}}
                <img
                    src="{{ asset('IMG/qr-pembayaran.png') }}"
                    width="250"
                    alt="QR Pembayaran">

                <p class="mt-3 text-muted">
                    Scan QR menggunakan aplikasi mobile banking atau e-wallet.
                </p>

            </div>

            <form
                action="{{ route('ortu.tagihan.submit',$tagihan->id_tagihan) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Tanggal Bayar
                    </label>

                    <input
                        type="date"
                        name="tanggal_bayar"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Bukti Transfer
                    </label>

                    <input
                        type="file"
                        name="bukti_transfer"
                        class="form-control"
                        accept=".jpg,.jpeg,.png"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Catatan
                    </label>

                    <textarea
                        name="catatan"
                        rows="3"
                        class="form-control"></textarea>
                </div>

                <div class="d-flex justify-content-between">

                    <a
                        href="{{ route('ortu.tagihan.index') }}"
                        class="btn btn-secondary">
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-submit text-white">
                        Kirim Bukti Transfer
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>
