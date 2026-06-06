<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Beasiswa;
use App\Models\PengajuanBeasiswa;

class OrtuBeasiswaController extends Controller
{
    public function create()
    {
        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('siswa.id_walimurid', session('id_walimurid'))
            ->select(
                'siswa.id_siswa',
                'siswa.nis',
                'siswa.nama',
                'kelas.nama_kelas as kelas'
            )
            ->get();

        $beasiswa = DB::table('beasiswa as b')
            ->select(
                'b.*',
                DB::raw("
                (
                    b.kuota -
                    (
                        SELECT COUNT(*)
                        FROM beasiswa_siswa bs
                        WHERE bs.id_beasiswa = b.id_beasiswa
                        AND bs.status = 'AKTIF'
                    )
                ) as sisa_slot
            ")
            )
            ->where('b.status', 'AKTIF')
            ->get();

        return view(
            'ortu.pengajuan-beasiswa',
            compact('siswa', 'beasiswa')
        );
    }

    public function store(Request $request)
    {
        // PERBAIKAN 1: Jalankan validasi input form terlebih dahulu sebelum mengecek logika database
        $request->validate([
            'id_siswa'    => 'required', // Tambahan wajib agar id_siswa terproteksi
            'id_beasiswa' => 'required',
            'nis'         => 'required',
            'nama'        => 'required',
            'kelas'       => 'required',
            'nilai_bindo' => 'required|numeric|min:0|max:100',
            'nilai_bing'  => 'required|numeric|min:0|max:100',
            'nilai_mtk'   => 'required|numeric|min:0|max:100',
            'nilai_pkn'   => 'required|numeric|min:0|max:100',
            'nilai_ipa'   => 'required|numeric|min:0|max:100',
            'nilai_ips'   => 'required|numeric|min:0|max:100',
        ]);

        // 1. Cek apakah siswa sudah punya beasiswa aktif
        $cekBeasiswaAktif = DB::table('beasiswa_siswa')
            ->where('id_siswa', $request->id_siswa)
            ->where('status', 'AKTIF')
            ->exists();

        if ($cekBeasiswaAktif) {
            return back()
                ->withInput()
                ->with('error', 'Siswa sudah memiliki beasiswa aktif dan tidak dapat mengambil beasiswa kedua.');
        }

        // 2. Cek apakah masih ada pengajuan yang menunggu
        $cekPengajuan = DB::table('pengajuan_beasiswa')
            ->where('id_siswa', $request->id_siswa)
            ->where('status', 'Menunggu')
            ->exists();

        if ($cekPengajuan) {
            return back()
                ->withInput()
                ->with('error', 'Masih ada pengajuan beasiswa yang belum diproses.');
        }

        // 3. Cek kuota beasiswa
        $beasiswa = Beasiswa::findOrFail($request->id_beasiswa);

        $jumlahPenerima = DB::table('beasiswa_siswa')
            ->where('id_beasiswa', $request->id_beasiswa)
            ->where('status', 'AKTIF')
            ->count();

        $sisaSlot = $beasiswa->kuota - $jumlahPenerima;

        if ($sisaSlot <= 0) {
            return back()
                ->withInput()
                ->with('error', 'Kuota beasiswa sudah habis.');
        }

        // Perhitungan nilai rata-rata
        $rata = (
                $request->nilai_bindo +
                $request->nilai_bing +
                $request->nilai_mtk +
                $request->nilai_pkn +
                $request->nilai_ipa +
                $request->nilai_ips
            ) / 6;

        // Simpan data pengajuan
        PengajuanBeasiswa::create([
            'id_beasiswa'  => $request->id_beasiswa,
            'id_siswa'     => $request->id_siswa,
            'id_walimurid' => session('id_walimurid'),
            'nis'          => $request->nis,
            'nama'         => $request->nama,
            'kelas'        => $request->kelas,
            'nilai_bindo'  => $request->nilai_bindo,
            'nilai_bing'   => $request->nilai_bing,
            'nilai_mtk'    => $request->nilai_mtk,
            'nilai_pkn'    => $request->nilai_pkn,
            'nilai_ipa'    => $request->nilai_ipa,
            'nilai_ips'    => $request->nilai_ips,
            'rata_rata'    => $rata,
            'status'       => 'Menunggu'
        ]);

        return redirect()
            ->route('ortu.beasiswa.create')
            ->with('success', 'Pengajuan beasiswa berhasil dikirim.');
    }
}
