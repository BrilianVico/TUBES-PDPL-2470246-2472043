<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Support\Facades\DB;

class DashboardOrtuController extends Controller
{
    public function index()
    {
        // Ambil ID wali murid yang login
        $idWali = session('id_walimurid');

        // Ambil data anak milik wali murid
        $anakAnak = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('siswa.id_walimurid', $idWali)
            ->select(
                'siswa.id_siswa',
                'siswa.nis',
                'siswa.nama',
                'kelas.nama_kelas'
            )
            ->get();

        // Ambil pengumuman yang sudah dibaca oleh wali murid
        $readAnnouncements = DB::table('pengumuman_read')
            ->where('id_walimurid', $idWali)
            ->pluck('id_pengumuman')
            ->toArray();

        // Ambil pengumuman yang sesuai dengan target di sistem
        $pengumuman = \App\Models\Pengumuman::query()
            ->sedangTayang()
            ->whereNotIn('id_pengumuman', $readAnnouncements)
            ->where(function ($query) use ($anakAnak) {

                // 1. Ambil yang targetnya 'Semua' ATAU 'Orang Tua' (untuk semua wali murid)
                $query->where('target', 'Semua')
                    ->orWhere('target', 'Orang Tua')
                    ->orWhere('target', 'LIKE', '%Orang Tua%');

                // 2. Ambil yang spesifik berdasarkan nama dan kelas anak
                foreach ($anakAnak as $anak) {
                    $query->orWhere(function($q) use ($anak) {
                        // Mencocokkan format "Siswa: Nama Siswa" atau nama langsung
                        $q->where('target', 'LIKE', '%Siswa:%' . $anak->nama . '%')
                            ->orWhere('target', 'LIKE', '%' . $anak->nama . '%')
                            // Mencocokkan format Kelas (baik "Kelas: 7A", "Kelas 7A", atau "7A")
                            ->orWhere('target', 'LIKE', '%' . $anak->nama_kelas . '%');
                    });
                }
            })
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        return view(
            'dashboard_ortu',
            compact(
                'pengumuman',
                'anakAnak'
            )
        );
    }

    public function getNotificationCounts()
    {
        $idWali = session('id_walimurid');

        $anakAnak = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('siswa.id_walimurid', $idWali)
            ->select('siswa.nama', 'kelas.nama_kelas')
            ->get();

        $readAnnouncements = DB::table('pengumuman_read')
            ->where('id_walimurid', $idWali)
            ->pluck('id_pengumuman')
            ->toArray();

        $notifPengumumanOrtu = \App\Models\Pengumuman::query()
            ->sedangTayang()
            ->whereNotIn('id_pengumuman', $readAnnouncements)
            ->where(function ($query) use ($anakAnak) {
                $query->where('target', 'Semua')
                    ->orWhere('target', 'Orang Tua')
                    ->orWhere('target', 'LIKE', '%Orang Tua%');
                foreach ($anakAnak as $anak) {
                    $query->orWhere(function($q) use ($anak) {
                        $q->where('target', 'LIKE', '%Siswa:%' . $anak->nama . '%')
                            ->orWhere('target', 'LIKE', '%' . $anak->nama . '%')
                            ->orWhere('target', 'LIKE', '%' . $anak->nama_kelas . '%');
                    });
                }
            })
            ->count();

        $notifBeasiswaOrtu = 0;
        if (class_exists(\App\Models\PengajuanBeasiswa::class)) {
            $notifBeasiswaOrtu = \App\Models\PengajuanBeasiswa::where('id_walimurid', $idWali)
                ->whereIn('status', ['Diterima', 'Ditolak'])
                ->where('is_read_ortu', 0)
                ->count();
        }

        $notifTagihanOrtu = DB::table('tagihan as t')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->where('s.id_walimurid', $idWali)
            ->whereIn('t.status', ['BELUM', 'DITOLAK'])
            ->count();

        return response()->json([
            'notifPengumumanOrtu' => $notifPengumumanOrtu,
            'notifBeasiswaOrtu' => $notifBeasiswaOrtu,
            'notifTagihanOrtu' => $notifTagihanOrtu,
        ]);
    }

    public function markAsRead($id)
    {
        $idWali = session('id_walimurid');

        DB::table('pengumuman_read')->updateOrInsert(
            ['id_pengumuman' => $id, 'id_walimurid' => $idWali],
            ['created_at' => now(), 'updated_at' => now()]
        );

        return response()->json(['success' => true]);
    }

    public function getLiveAnnouncements()
    {
        $idWali = session('id_walimurid');

        $anakAnak = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('siswa.id_walimurid', $idWali)
            ->select('siswa.nama', 'kelas.nama_kelas')
            ->get();

        $readAnnouncements = DB::table('pengumuman_read')
            ->where('id_walimurid', $idWali)
            ->pluck('id_pengumuman')
            ->toArray();

        $pengumuman = \App\Models\Pengumuman::query()
            ->sedangTayang()
            ->whereNotIn('id_pengumuman', $readAnnouncements)
            ->where(function ($query) use ($anakAnak) {
                $query->where('target', 'Semua')
                    ->orWhere('target', 'Orang Tua')
                    ->orWhere('target', 'LIKE', '%Orang Tua%');
                foreach ($anakAnak as $anak) {
                    $query->orWhere(function($q) use ($anak) {
                        $q->where('target', 'LIKE', '%Siswa:%' . $anak->nama . '%')
                            ->orWhere('target', 'LIKE', '%' . $anak->nama . '%')
                            ->orWhere('target', 'LIKE', '%' . $anak->nama_kelas . '%');
                    });
                }
            })
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        $formatted = $pengumuman->map(function ($item) {
            return [
                'id_pengumuman' => $item->id_pengumuman,
                'judul' => $item->judul,
                'isi' => $item->isi,
                'tanggal_formatted' => \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y')
            ];
        });

        return response()->json(['announcements' => $formatted]);
    }
}
