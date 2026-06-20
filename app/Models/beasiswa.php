<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';

    protected $primaryKey = 'id_beasiswa';

    protected $fillable = [
        'nama_beasiswa',
        'jenis',
        'nominal',
        'deskripsi',
        'persentase_potongan',
        'status',
        'kuota',

        // ABSTRACT PATTERN
        'jenis_potongan',
        'nilai_potongan',
        'berlaku_untuk',

        // TAMBAHKAN KOLOM PERIODE DI BAWAH INI AGAR TIDAK DI-BLOK OLEH LARAVEL:
        'bulan_buka',
        'tahun_buka',
        'bulan_tutup',
        'tahun_tutup',
        'durasi_potongan',
    ];

    public $timestamps = false;
}
