<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeasiswaSiswa extends Model
{
    protected $table = 'beasiswa_siswa';
    public $timestamps = false;

    protected $fillable = [
        'id_beasiswa',
        'id_siswa',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];
}
