<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    /**
     * Nama tabel di database
     */
    protected $table = 'pengumuman';

    /**
     * Primary key tabel
     */
    protected $primaryKey = 'id_pengumuman';

    /**
     * Primary key bukan auto increment integer default Laravel
     */
    protected $keyType = 'int';

    /**
     * Gunakan created_at dan updated_at
     */
    public $timestamps = true;

    /**
     * Field yang boleh diisi mass assignment
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
     * Scope: hanya pengumuman aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    /**
     * Scope: pengumuman yang sedang tayang
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

    /**
     * Accessor: cek apakah pengumuman sedang aktif tayang
     */
    public function getIsAktifAttribute()
    {
        if ($this->status !== 'Aktif') {
            return false;
        }

        $today = now()->toDateString();

        if ($this->tanggal_mulai > $today) {
            return false;
        }

        if ($this->tanggal_selesai && $this->tanggal_selesai < $today) {
            return false;
        }

        return true;
    }
}
