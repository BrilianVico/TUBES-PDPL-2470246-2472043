<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Tagihan;
use App\Observers\TagihanObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Tagihan::observe(TagihanObserver::class);

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (class_exists(\App\Models\PengajuanBeasiswa::class)) {
                $notifBeasiswaAdmin = \App\Models\PengajuanBeasiswa::where('status', 'Menunggu')->count();
                $view->with('notifBeasiswaAdmin', $notifBeasiswaAdmin);
            }

            if (class_exists(\App\Models\Pembayaran::class)) {
                $notifPembayaranAdmin = \App\Models\Pembayaran::where('status_bayar', 'BELUM')->count();
                $view->with('notifPembayaranAdmin', $notifPembayaranAdmin);
            }

            if (session()->has('id_walimurid')) {
                $idWali = session('id_walimurid');
                $anakAnak = \Illuminate\Support\Facades\DB::table('siswa')
                    ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                    ->where('siswa.id_walimurid', $idWali)
                    ->select('siswa.nama', 'kelas.nama_kelas')
                    ->get();
                $readAnnouncements = \Illuminate\Support\Facades\DB::table('pengumuman_read')
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
                $view->with('notifPengumumanOrtu', $notifPengumumanOrtu);

                if (class_exists(\App\Models\PengajuanBeasiswa::class)) {
                    $notifBeasiswaOrtu = \App\Models\PengajuanBeasiswa::where('id_walimurid', $idWali)
                        ->whereIn('status', ['Diterima', 'Ditolak'])
                        ->where('is_read_ortu', 0)
                        ->count();
                    $view->with('notifBeasiswaOrtu', $notifBeasiswaOrtu);
                }

                $notifTagihanOrtu = \Illuminate\Support\Facades\DB::table('tagihan as t')
                    ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
                    ->where('s.id_walimurid', $idWali)
                    ->whereIn('t.status', ['BELUM', 'DITOLAK'])
                    ->count();
                $view->with('notifTagihanOrtu', $notifTagihanOrtu);
            }
        });
    }
}
