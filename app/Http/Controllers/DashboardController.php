<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Total Siswa Aktif
        |--------------------------------------------------------------------------
        | Hanya menghitung siswa dengan status_siswa = 'Aktif'
        |--------------------------------------------------------------------------
        | Serta mengambil seluruh siswa
        */
        $totalSiswa = DB::table('siswa')
            ->where('status_siswa', 'Aktif')
            ->count();

        $siswa = DB::table('vw_admin_data_siswa')
            ->where('status_siswa', 'Aktif')
            ->orderBy('nis', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Total Tagihan & Seluruh Tagihan
        |--------------------------------------------------------------------------
        */
        $totalTagihan = DB::table('tagihan')->count();

        $tagihan = DB::table('tagihan as t')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->select('t.*', 's.nis', 's.nama')
            ->orderBy('t.id_tagihan', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Pembayaran Hari Ini & Seluruh Pembayaran
        |--------------------------------------------------------------------------
        | Menggunakan kolom tanggal_bayar pada tabel pembayaran
        |--------------------------------------------------------------------------
        */
        $pembayaranHariIni = DB::table('pembayaran')
            ->whereDate('tanggal_bayar', today())
            ->count();

        $pembayaran = DB::table('pembayaran as p')
            ->join('tagihan as t', 'p.id_tagihan', '=', 't.id_tagihan')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->select('p.*', 's.nis', 's.nama', 't.jenis_tagihan')
            ->orderBy('p.id_pembayaran', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Pengajuan Beasiswa
        |--------------------------------------------------------------------------
        | Jika tabel belum tersedia, ubah menjadi 0
        |--------------------------------------------------------------------------
        */
        $pengajuanBeasiswa = DB::table('pengajuan_beasiswa')->count();

        $pengajuanBeasiswaList = DB::table('pengajuan_beasiswa as pb')
            ->join('siswa as s', 'pb.id_siswa', '=', 's.id_siswa')
            ->join('beasiswa as b', 'pb.id_beasiswa', '=', 'b.id_beasiswa')
            ->select('pb.*', 's.nis', 's.nama', 'b.nama_beasiswa')
            ->orderBy('pb.id_pengajuan', 'desc')
            ->get();

        return view('dashboard', compact(
            'totalSiswa',
            'totalTagihan',
            'pembayaranHariIni',
            'pengajuanBeasiswa',
            'siswa',
            'tagihan',
            'pembayaran',
            'pengajuanBeasiswaList'
        ));
    }
}
