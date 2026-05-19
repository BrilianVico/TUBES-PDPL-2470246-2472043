<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /**
     * Nama tabel di database
     */
    protected $table = 'pembayaran';

    /**
     * Primary key
     */
    protected $primaryKey = 'id_pembayaran';

    /**
     * Tabel tidak menggunakan created_at dan updated_at
     */
    public $timestamps = false;

    /**
     * Field yang boleh diisi
     */
    protected $fillable = [
        'id_tagihan',
        'id_walimurid',
        'nominal_bayar',
        'status_bayar',
        'tanggal_bayar',
    ];

    /**
     * Casting otomatis
     */
    protected $casts = [
        'nominal_bayar' => 'decimal:2',
        'tanggal_bayar' => 'date',
    ];

    /**
     * Relasi ke tabel tagihan
     */
    public function tagihan()
    {
        return $this->belongsTo(
            Tagihan::class,
            'id_tagihan',
            'id_tagihan'
        );
    }

    /**
     * Relasi ke tabel wali murid
     */
    public function waliMurid()
    {
        return $this->belongsTo(
            WaliMurid::class,
            'id_walimurid',
            'id_walimurid'
        );
    }

    /**
     * Scope pembayaran yang sudah lunas
     */
    public function scopeLunas($query)
    {
        return $query->where('status_bayar', 'LUNAS');
    }

    /**
     * Scope pembayaran yang belum diverifikasi
     */
    public function scopeBelum($query)
    {
        return $query->where('status_bayar', 'BELUM');
    }

    /**
     * Accessor untuk format rupiah
     */
    public function getNominalRupiahAttribute()
    {
        return 'Rp ' . number_format($this->nominal_bayar, 0, ',', '.');
    }
}
