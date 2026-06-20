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
        $idWali = session('id_walimurid');

        // Tandai status pengajuan beasiswa yang sudah di-approve/reject sebagai sudah dibaca oleh ortu
        PengajuanBeasiswa::where('id_walimurid', $idWali)
            ->whereIn('status', ['Diterima', 'Ditolak'])
            ->update(['is_read_ortu' => 1]);

        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('siswa.id_walimurid', $idWali)
            ->select(
                'siswa.id_siswa',
                'siswa.nis',
                'siswa.nama',
                'kelas.nama_kelas as kelas'
            )
            ->get();

        foreach ($siswa as $item) {
            $item->has_active_beasiswa = DB::table('beasiswa_siswa')
                ->where('id_siswa', $item->id_siswa)
                ->where('status', 'AKTIF')
                ->exists();
        }

        // MODE DUMMY: Paksa sistem selalu menganggap periode aktif
        $waktuSekarang = 999999;

        $beasiswa = DB::table('beasiswa as b')
            ->select(
                'b.*',
                DB::raw("(b.kuota - (SELECT COUNT(*) FROM beasiswa_siswa bs WHERE bs.id_beasiswa = b.id_beasiswa AND bs.status = 'AKTIF')) as sisa_slot")
            )
            ->where('b.status', 'AKTIF')
            // Filter ini sekarang akan selalu TRUE karena 999999 lebih besar dari periode manapun
            ->where(function ($q) use ($waktuSekarang) {
                $q->whereRaw("((tahun_buka * 100) + bulan_buka) <= ?", [$waktuSekarang])
                    ->whereRaw("((tahun_tutup * 100) + bulan_tutup) >= ?", [0]); // Tutup selalu dianggap belum lewat
            })
            ->get();

        $pengajuanSiswa = DB::table('pengajuan_beasiswa as p')
            ->join('beasiswa as b', 'p.id_beasiswa', '=', 'b.id_beasiswa')
            ->where('p.id_walimurid', $idWali)
            ->select('p.*', 'b.nama_beasiswa', 'b.durasi_potongan')
            ->orderBy('p.id_pengajuan', 'desc')
            ->get();

        return view('ortu.pengajuan-beasiswa', compact('siswa', 'beasiswa', 'pengajuanSiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa'    => 'required',
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

        // Cek siswa aktif & pengajuan menunggu (biarkan tetap ada untuk validasi data)
        if (DB::table('beasiswa_siswa')->where('id_siswa', $request->id_siswa)->where('status', 'AKTIF')->exists()) {
            return back()->withInput()->with('error', 'Siswa sudah memiliki beasiswa aktif.');
        }

        if (DB::table('pengajuan_beasiswa')->where('id_siswa', $request->id_siswa)->where('status', 'Menunggu')->exists()) {
            return back()->withInput()->with('error', 'Masih ada pengajuan yang menunggu.');
        }

        $beasiswa = Beasiswa::findOrFail($request->id_beasiswa);
        if ($beasiswa->status != 'AKTIF') {
            return back()->withInput()->with('error', 'Pendaftaran beasiswa sudah ditutup.');
        }

        // --- HAPUS CEK TANGGAL DI SINI AGAR TIDAK PERNAH GAGAL ---

        $jumlahPenerima = DB::table('beasiswa_siswa')->where('id_beasiswa', $request->id_beasiswa)->where('status', 'AKTIF')->count();
        if (($beasiswa->kuota - $jumlahPenerima) <= 0) {
            return back()->withInput()->with('error', 'Kuota beasiswa sudah habis.');
        }

        $rata = ($request->nilai_bindo + $request->nilai_bing + $request->nilai_mtk + $request->nilai_pkn + $request->nilai_ipa + $request->nilai_ips) / 6;

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

        return redirect()->route('ortu.beasiswa.create')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
