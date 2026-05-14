<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';
    protected $primaryKey = 'id_beasiswa';
    public $timestamps = false;

    protected $fillable = [
        'nama_beasiswa',
        'deskripsi',
        'nominal_potongan',
        'kuota',
        'status'
    ];
}
