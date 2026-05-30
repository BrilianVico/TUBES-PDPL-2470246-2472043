<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeasiswaSiswa extends Model
{
    protected $table = 'beasiswa_siswa';

    protected $fillable = [
        'id_siswa',
        'id_beasiswa'
    ];

    public $timestamps = false;
}
