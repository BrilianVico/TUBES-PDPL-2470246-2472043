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
        'berlaku_untuk'
    ];

    public $timestamps = false;
}
