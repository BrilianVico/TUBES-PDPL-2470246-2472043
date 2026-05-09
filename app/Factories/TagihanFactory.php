<?php

namespace App\Factories;

use App\Models\Tagihan;

class TagihanFactory
{
    public static function create($jenis, $idSiswa)
    {
        $referensi = Tagihan::where('jenis_tagihan', $jenis)
            ->latest('id_tagihan')
            ->first();

        $nominalDasar = $referensi ? $referensi->nominal : 0;

        return [
            'id_siswa' => $idSiswa,
            'jenis_tagihan' => $jenis,
            'nominal' => $nominalDasar,
            'status' => 'BELUM',
            'sumber_tagihan' => 'FACTORY PATTERN',
            'potongan_beasiswa' => 0
        ];
    }
}
