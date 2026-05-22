<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class DashboardOrtuController extends Controller
{
    public function index()
    {
        // Ambil semua pengumuman yang aktif dan sedang tayang
        $pengumuman = Pengumuman::sedangTayang()
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        return view('dashboard_ortu', compact('pengumuman'));
    }
}
