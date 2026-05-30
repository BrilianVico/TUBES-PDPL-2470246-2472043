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
        'kuota'
    ];

    public $timestamps = false;
}
