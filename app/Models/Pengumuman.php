<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    /**
     * Nama tabel
     */
    protected $table = 'pengumuman';

    /**
     * Primary key
     */
    protected $primaryKey = 'id_pengumuman';

    /**
     * Gunakan created_at dan updated_at
     */
    public $timestamps = true;

    /**
     * Field yang boleh diisi
     */
    protected $fillable = [
        'judul',
        'isi',
        'tanggal_mulai',
        'tanggal_selesai',
        'target',
        'status',
    ];

    /**
     * Casting otomatis
     */
    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Scope pengumuman aktif dan sedang tayang
     */
    public function scopeSedangTayang($query)
    {
        return $query
            ->where('status', 'Aktif')
            ->whereDate('tanggal_mulai', '<=', now())
            ->where(function ($q) {
                $q->whereNull('tanggal_selesai')
                    ->orWhereDate('tanggal_selesai', '>=', now());
            });
    }
}
