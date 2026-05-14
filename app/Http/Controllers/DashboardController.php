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
        */
        $totalSiswa = DB::table('siswa')
            ->where('status_siswa', 'Aktif')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Total Tagihan
        |--------------------------------------------------------------------------
        */
        $totalTagihan = DB::table('tagihan')->count();

        /*
        |--------------------------------------------------------------------------
        | Pembayaran Hari Ini
        |--------------------------------------------------------------------------
        | Menggunakan kolom tanggal_bayar pada tabel pembayaran
        |--------------------------------------------------------------------------
        */
        $pembayaranHariIni = DB::table('pembayaran')
            ->whereDate('tanggal_bayar', today())
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Pengajuan Beasiswa
        |--------------------------------------------------------------------------
        | Jika tabel belum tersedia, ubah menjadi 0
        |--------------------------------------------------------------------------
        */
        $pengajuanBeasiswa = DB::table('pengajuan_beasiswa')->count();
        // Jika tabel belum ada:
        // $pengajuanBeasiswa = 0;

        return view('dashboard', compact(
            'totalSiswa',
            'totalTagihan',
            'pembayaranHariIni',
            'pengajuanBeasiswa'
        ));
    }
}
