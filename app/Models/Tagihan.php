<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    protected $primaryKey = 'id_tagihan';

    public $timestamps = false;

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

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_tagihan', 'id_tagihan');
    }

    public function getNominalAkhirAttribute()
    {
        return max(
            $this->nominal - ($this->potongan_beasiswa ?? 0),
            0
        );
    }
}
