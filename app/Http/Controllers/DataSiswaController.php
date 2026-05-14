<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil id_kelas dari dropdown
        $idKelas = $request->id_kelas;

        // Ambil semua kelas untuk dropdown
        $kelas = DB::table('kelas')
            ->orderBy('nama_kelas', 'asc')
            ->get();

        // Query dasar dari view
        $query = DB::table('vw_admin_data_siswa')
            ->where('status_siswa', 'Aktif');

        /*
        |--------------------------------------------------------------------------
        | Filter berdasarkan kelas
        |--------------------------------------------------------------------------
        | Karena vw_admin_data_siswa tidak memiliki kolom id_kelas,
        | kita ambil nama kelas dari tabel kelas, lalu filter berdasarkan
        | kolom nama_kelas pada view.
        |--------------------------------------------------------------------------
        */
        if (!empty($idKelas)) {
            $kelasDipilih = DB::table('kelas')
                ->where('id_kelas', $idKelas)
                ->first();

            if ($kelasDipilih) {
                $query->where('nama_kelas', $kelasDipilih->nama_kelas);
            }
        }

        // Ambil data siswa
        $siswa = $query
            ->orderBy('nis', 'asc')
            ->get();

        // Kirim ke view
        return view('admin.data-siswa', [
            'siswa'   => $siswa,
            'kelas'   => $kelas,
            'idKelas' => $idKelas,
        ]);
    }
}
