<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Tagihan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f7fb;
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
            background:linear-gradient(135deg,#176d4c,#0f5132);
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
            background:#176d4c;
            border:none;
            border-radius:12px;
            padding:12px;
            font-weight:600;
        }

        .btn-submit:hover{
            background:#0f5132;
        }
    </style>
</head>
<body>

<div class="container-box">

    <div class="card card-custom">

        <div class="header">
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
