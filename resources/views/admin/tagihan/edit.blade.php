<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tagihan - SMP Sunodia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow border-0">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Tagihan</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.tagihan.update', $tagihan->id_tagihan) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Siswa --}}
                <div class="mb-3">
                    <label class="form-label">Siswa</label>
                    <select name="id_siswa" class="form-select" required>
                        <option value="">Pilih Siswa</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id_siswa }}"
                                {{ old('id_siswa', $tagihan->id_siswa) == $s->id_siswa ? 'selected' : '' }}>
                                {{ $s->nis }} - {{ $s->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jenis Tagihan --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Tagihan</label>
                    <select name="jenis_tagihan" class="form-select" required>
                        @php
                            $jenisList = ['SPP', 'Buku', 'Seragam', 'Ujian'];
                        @endphp

                        @foreach($jenisList as $jenis)
                            <option value="{{ $jenis }}"
                                {{ old('jenis_tagihan', $tagihan->jenis_tagihan) == $jenis ? 'selected' : '' }}>
                                {{ $jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Nominal --}}
                <div class="mb-3">
                    <label class="form-label">Nominal</label>
                    <input type="number"
                           name="nominal"
                           class="form-control"
                           value="{{ old('nominal', $tagihan->nominal) }}"
                           required>
                </div>

                {{-- Bulan, Tahun, Tahun Ajaran --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="text"
                               name="bulan"
                               class="form-control"
                               value="{{ old('bulan', $tagihan->bulan) }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number"
                               name="tahun"
                               class="form-control"
                               value="{{ old('tahun', $tagihan->tahun) }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tahun Ajaran</label>
                        <input type="text"
                               name="tahun_ajaran"
                               class="form-control"
                               value="{{ old('tahun_ajaran', $tagihan->tahun_ajaran) }}"
                               required>
                    </div>
                </div>

                {{-- Potongan Beasiswa --}}
                <div class="mb-3">
                    <label class="form-label">Potongan Beasiswa</label>
                    <input type="number"
                           name="potongan_beasiswa"
                           class="form-control"
                           value="{{ old('potongan_beasiswa', $tagihan->potongan_beasiswa ?? 0) }}">
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Belum Lunas"
                            {{ old('status', $tagihan->status) == 'Belum Lunas' ? 'selected' : '' }}>
                            Belum Lunas
                        </option>
                        <option value="Lunas"
                            {{ old('status', $tagihan->status) == 'Lunas' ? 'selected' : '' }}>
                            Lunas
                        </option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.tagihan.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-warning text-dark">
                        Update Tagihan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
