<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    protected $primaryKey = 'id_tagihan';

    protected $fillable = [
        'id_siswa',
        'bulan',
        'tahun',
        'tahun_ajaran',
        'jenis_tagihan',
        'nominal',
        'status',
        'sumber_tagihan',
        'potongan_beasiswa'
    ];
}
