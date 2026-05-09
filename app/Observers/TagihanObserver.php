<?php

namespace App\Observers;

use App\Models\Tagihan;

class TagihanObserver
{
    public function created(Tagihan $tagihan)
    {
        \Log::info(
            'Notifikasi: Tagihan baru dibuat untuk siswa ID ' .
            $tagihan->id_siswa .
            ' jenis ' .
            $tagihan->jenis_tagihan
        );
    }
}
