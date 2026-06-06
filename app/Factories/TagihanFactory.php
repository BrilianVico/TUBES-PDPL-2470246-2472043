<?php

namespace App\Factories;

class TagihanFactory
{
    public static function create($jenis, $idSiswa)
    {
        switch ($jenis) {

            case 'SPP':
                $nominal = 500000;
                break;

            case 'Buku':
                $nominal = 350000;
                break;

            case 'Seragam':
                $nominal = 750000;
                break;

            case 'Pembangunan':
                $nominal = 1000000;
                break;

            case 'Ujian':
                $nominal = 250000;
                break;

            case 'Kegiatan':
                $nominal = 150000;
                break;

            default:
                $nominal = 0;
                break;
        }

        return [
            'id_siswa'            => $idSiswa,
            'jenis_tagihan'       => $jenis,
            'nominal'             => $nominal,
            'status'              => 'BELUM',
            'sumber_tagihan'      => 'FACTORY PATTERN',
            'potongan_beasiswa'   => 0
        ];
    }
}
