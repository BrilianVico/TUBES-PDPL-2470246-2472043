<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanBeasiswa extends Model
{
    protected $table = 'pengajuan_beasiswa';

    protected $primaryKey = 'id_pengajuan';

    protected $fillable = [
        'id_beasiswa',
        'id_siswa',
        'id_walimurid',

        'nis',
        'nama',
        'kelas',

        'nilai_bindo',
        'nilai_bing',
        'nilai_mtk',
        'nilai_pkn',
        'nilai_ipa',
        'nilai_ips',

        'rata_rata',
        'status'
    ];
}
