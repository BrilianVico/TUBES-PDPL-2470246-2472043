<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\BeasiswaSiswa;
use App\Models\PengajuanBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeasiswaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CRUD PROGRAM BEASISWA
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // Mengambil data dan mengurutkan berdasarkan ID terbaru
        $beasiswa = \App\Models\Beasiswa::orderBy('id_beasiswa', 'desc')->get();
        return view('admin.beasiswa.index', compact('beasiswa'));
    }

    public function create()
    {
        return view('admin.beasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_beasiswa'     => 'required',
            'deskripsi'         => 'required',
            'jenis_potongan'    => 'required',
            'nilai_potongan'    => 'required|numeric|min:1',
            'berlaku_untuk'     => 'required',
            'kuota'             => 'required|integer|min:1',
            'status'            => 'required',
            'bulan_buka'        => 'required',
            'tahun_buka'        => 'required',
            'bulan_tutup'       => 'required',
            'tahun_tutup'       => 'required',
            'durasi_potongan'   => 'required|integer|min:1',
        ]);

        if (
            ($request->tahun_tutup < $request->tahun_buka)
            ||
            (
                $request->tahun_tutup == $request->tahun_buka
                &&
                $request->bulan_tutup < $request->bulan_buka
            )
        ) {
            return back()
                ->withInput()
                ->with('error', 'Periode tutup tidak boleh lebih awal dari periode buka.');
        }

        $cekBeasiswa = Beasiswa::where('bulan_buka', $request->bulan_buka)
            ->where('tahun_buka', $request->tahun_buka)
            ->exists();

        if ($cekBeasiswa) {
            return back()
                ->withInput()
                ->with('error', 'Gagal membuat beasiswa! Beasiswa untuk bulan buka tersebut sudah pernah dibuat.');
        }

        $beasiswa = Beasiswa::create([
            'nama_beasiswa'       => $request->nama_beasiswa,
            'jenis'               => 'POTONGAN',
            'nominal'             => 0,
            'deskripsi'           => $request->deskripsi,
            'jenis_potongan'      => strtoupper($request->jenis_potongan),
            'nilai_potongan'      => $request->nilai_potongan,
            'berlaku_untuk'       => strtoupper($request->berlaku_untuk),
            'persentase_potongan' => 0,
            'kuota'               => $request->kuota,
            'status'              => strtoupper($request->status),
            'bulan_buka'          => $request->bulan_buka,
            'tahun_buka'          => $request->tahun_buka,
            'bulan_tutup'         => $request->bulan_tutup,
            'tahun_tutup'         => $request->tahun_tutup,
            'durasi_potongan'     => $request->durasi_potongan,
        ]);

        // Tambah Pengumuman otomatis ke portal ortu
        try {
            $bulanNama = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            $bulanBukaText = $bulanNama[(int)$request->bulan_buka] ?? $request->bulan_buka;
            $bulanTutupText = $bulanNama[(int)$request->bulan_tutup] ?? $request->bulan_tutup;

            \App\Models\Pengumuman::create([
                'judul'           => 'Program Beasiswa Baru: ' . $request->nama_beasiswa,
                'isi'             => "Kabar gembira! Telah dibuka pendaftaran program beasiswa baru \"{$request->nama_beasiswa}\" dengan jenis potongan " . strtoupper($request->jenis_potongan) . " sebesar Rp " . number_format($request->nilai_potongan, 0, ',', '.') . ".\n\n" .
                                     "Deskripsi: {$request->deskripsi}\n" .
                                     "Kuota: {$request->kuota} siswa\n" .
                                     "Berlaku untuk: Kelas " . strtoupper($request->berlaku_untuk) . "\n" .
                                     "Periode Pendaftaran: {$bulanBukaText} {$request->tahun_buka} s/d {$bulanTutupText} {$request->tahun_tutup}.\n\n" .
                                     "Silakan lakukan pengajuan melalui menu Beasiswa pada portal Orang Tua.",
                'tanggal_mulai'   => now()->toDateString(),
                'tanggal_selesai' => now()->addMonth()->toDateString(),
                'target'          => 'Orang Tua',
                'status'          => 'Aktif',
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal membuat pengumuman beasiswa: ' . $e->getMessage());
        }

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, $id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        $request->validate([
            'nama_beasiswa'     => 'required',
            'deskripsi'         => 'required',
            'jenis_potongan'    => 'required',
            'nilai_potongan'    => 'required|numeric|min:1',
            'berlaku_untuk'     => 'required',
            'kuota'             => 'required|integer|min:1',
            'status'            => 'required',
            'bulan_buka'        => 'required',
            'tahun_buka'        => 'required',
            'bulan_tutup'       => 'required',
            'tahun_tutup'       => 'required',
            'durasi_potongan'   => 'required|integer|min:1',
        ]);

        if (
            ($request->tahun_tutup < $request->tahun_buka)
            ||
            (
                $request->tahun_tutup == $request->tahun_buka
                &&
                $request->bulan_tutup < $request->bulan_buka
            )
        ) {
            return back()
                ->withInput()
                ->with('error', 'Periode tutup tidak boleh lebih awal dari periode buka.');
        }

        $cekBeasiswa = Beasiswa::where('bulan_buka', $request->bulan_buka)
            ->where('tahun_buka', $request->tahun_buka)
            ->where('id_beasiswa', '!=', $id)
            ->exists();

        if ($cekBeasiswa) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui beasiswa! Beasiswa untuk bulan buka tersebut sudah pernah dibuat.');
        }

        $beasiswa->update([
            'nama_beasiswa'       => $request->nama_beasiswa,
            'jenis'               => 'POTONGAN',
            'nominal'             => 0,
            'deskripsi'           => $request->deskripsi,
            'jenis_potongan'      => strtoupper($request->jenis_potongan),
            'nilai_potongan'      => $request->nilai_potongan,
            'berlaku_untuk'       => strtoupper($request->berlaku_untuk),
            'persentase_potongan' => 0,
            'kuota'               => $request->kuota,
            'status'              => strtoupper($request->status),
            'bulan_buka'          => $request->bulan_buka,
            'tahun_buka'          => $request->tahun_buka,
            'bulan_tutup'         => $request->bulan_tutup,
            'tahun_tutup'         => $request->tahun_tutup,
            'durasi_potongan'     => $request->durasi_potongan,
        ]);

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil diperbarui.');
    }

    /**
     * PERBAIKAN: Menghapus data relasi di tabel anak terlebih dahulu
     */
    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        // 1. Hapus semua data siswa yang mengambil beasiswa ini di tabel beasiswa_siswa
        BeasiswaSiswa::where('id_beasiswa', $id)->delete();

        // 2. Baru hapus data program beasiswanya
        $beasiswa->delete();

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa beserta relasi data siswa berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | PENGAJUAN BEASISWA
    |--------------------------------------------------------------------------
    */

    public function pengajuan()
    {
        $pengajuan = DB::table('pengajuan_beasiswa as p')
            ->join('siswa as s', 'p.id_siswa', '=', 's.id_siswa')
            ->join('beasiswa as b', 'p.id_beasiswa', '=', 'b.id_beasiswa')
            ->select(
                'p.*',
                's.nama',
                's.nis',
                'b.nama_beasiswa',
                'b.jenis_potongan',
                'b.nilai_potongan',
                'b.berlaku_untuk',
                'b.kuota',

                'b.bulan_buka',
                'b.tahun_buka',
                'b.bulan_tutup',
                'b.tahun_tutup'
            )
            ->orderBy('p.id_pengajuan', 'desc')
            ->get();

        return view('admin.beasiswa.pengajuan', compact('pengajuan'));
    }

    public function approvePengajuan($id)
    {
        $pengajuan = PengajuanBeasiswa::findOrFail($id);
        $beasiswa = Beasiswa::findOrFail($pengajuan->id_beasiswa);

        if ($beasiswa->kuota <= 0) {
            return back()->with('error', 'Kuota beasiswa sudah habis.');
        }

        // PERBAIKAN LOGIKA: Cek apakah siswa sudah memiliki beasiswa aktif untuk jenis tagihan yang sama (SPP / PEMBANGUNAN)
        $cekJenisSama = DB::table('beasiswa_siswa as bs')
            ->join('beasiswa as b', 'bs.id_beasiswa', '=', 'b.id_beasiswa')
            ->where('bs.id_siswa', $pengajuan->id_siswa)
            ->where('bs.status', 'AKTIF')
            ->where('b.berlaku_untuk', $beasiswa->berlaku_untuk)
            ->exists();

        if ($cekJenisSama) {
            return back()->with('error', 'Siswa sudah memiliki beasiswa yang aktif untuk jenis tagihan ' . $beasiswa->berlaku_untuk . '.');
        }

        // Ubah status pengajuan menjadi Diterima
        $pengajuan->update([
            'status' => 'Diterima',
            'is_read_ortu' => 0
        ]);

        // Hubungkan siswa dengan program beasiswa secara dinamis
        $cek = BeasiswaSiswa::where('id_siswa', $pengajuan->id_siswa)
            ->where('id_beasiswa', $pengajuan->id_beasiswa)
            ->first();

        if (!$cek) {
            BeasiswaSiswa::create([
                'id_siswa'             => $pengajuan->id_siswa,
                'id_beasiswa'          => $pengajuan->id_beasiswa,
                'sisa_potongan'        => $beasiswa->durasi_potongan,
                'bulan_mulai_potongan' => null,
                'tahun_mulai_potongan' => null,
                'status'               => 'AKTIF'
            ]);

            // Kurangi kuota program beasiswa
            $beasiswa->decrement('kuota');

            /*
            |--------------------------------------------------------------------------
            | LOGIKA POTONG TAGIHAN (Disesuaikan dengan kolom database asli kamu)
            |--------------------------------------------------------------------------
            */
            // Cari tagihan aktif siswa yang belum lunas sesuai jenis beasiswanya
            $tagihanAktif = DB::table('tagihan')
                ->where('id_siswa', $pengajuan->id_siswa)
                ->whereIn('status', ['BELUM', 'DITOLAK'])
                ->where('jenis_tagihan', $beasiswa->berlaku_untuk)
                ->first();

            if ($tagihanAktif) {
                // Potongan beasiswa hanya berlaku setelah masa pendaftaran tutup
                $waktuTagihan = ($tagihanAktif->tahun * 12) + $tagihanAktif->bulan;
                $waktuTutup = ($beasiswa->tahun_tutup * 12) + $beasiswa->bulan_tutup;

                if ($waktuTagihan > $waktuTutup) {
                    $nominalAwal = $tagihanAktif->nominal;
                    $nominalPotongan = 0;

                    // Hitung potongannya
                    if (strtoupper($beasiswa->jenis_potongan) == 'PERSEN') {
                        $nominalPotongan = ($nominalAwal * $beasiswa->nilai_potongan) / 100;
                    } else {
                        $nominalPotongan = min($nominalAwal, $beasiswa->nilai_potongan);
                    }

                    // Ambil nilai potongan_beasiswa yang sebelumnya (jika sudah ada, biar terakumulasi)
                    $potonganBeasiswaLama = $tagihanAktif->potongan_beasiswa ?? 0;
                    $potonganBeasiswaBaru = $potonganBeasiswaLama + $nominalPotongan;

                    // Update data tagihan di database tanpa memotong kolom nominal utama
                    DB::table('tagihan')
                        ->where('id_tagihan', $tagihanAktif->id_tagihan)
                        ->update([
                            'potongan_beasiswa' => $potonganBeasiswaBaru,
                        ]);

                    // Kurangi sisa potongan
                    DB::table('beasiswa_siswa')
                        ->where('id_siswa', $pengajuan->id_siswa)
                        ->where('id_beasiswa', $pengajuan->id_beasiswa)
                        ->decrement('sisa_potongan');

                    // Ubah status jadi SELESAI jika kuota potongan habis
                    if (DB::table('beasiswa_siswa')
                        ->where('id_siswa', $pengajuan->id_siswa)
                        ->where('id_beasiswa', $pengajuan->id_beasiswa)
                        ->value('sisa_potongan') <= 0) {
                        DB::table('beasiswa_siswa')
                            ->where('id_siswa', $pengajuan->id_siswa)
                            ->where('id_beasiswa', $pengajuan->id_beasiswa)
                            ->update(['status' => 'SELESAI']);
                    }
                }
            }
        }

        return back()->with('success', 'Pengajuan beasiswa berhasil disetujui.');
    }

    public function rejectPengajuan($id)
    {
        $pengajuan = PengajuanBeasiswa::findOrFail($id);

        $pengajuan->update([
            'status' => 'Ditolak',
            'is_read_ortu' => 0
        ]);

        return back()->with('success', 'Pengajuan beasiswa berhasil ditolak.');
    }
}
