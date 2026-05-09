<?php

namespace App\Facades;

use App\Factories\TagihanFactory;
use App\Models\Tagihan;
use App\Models\Beasiswa;
use App\Models\PengajuanBeasiswa;

use App\Decorators\TagihanDasar;
use App\Decorators\BeasiswaDecorator;

class BillingFacade
{
    public static function generate($request)
    {
        $data = TagihanFactory::create(
            $request->jenis_tagihan,
            $request->id_siswa
        );

        $tagihan = new TagihanDasar($data['nominal']);

        $pengajuan = PengajuanBeasiswa::where('id_siswa', $request->id_siswa)
            ->where('status', 'APPROVED')
            ->latest('id_pengajuan')
            ->first();

        if ($pengajuan) {

            $beasiswa = Beasiswa::find($pengajuan->id_beasiswa);

            $tagihan = new BeasiswaDecorator(
                $tagihan,
                $beasiswa->nominal
            );

            $data['potongan_beasiswa'] = $beasiswa->nominal;

        } else {
            $data['potongan_beasiswa'] = 0;
        }

        $data['nominal'] = $tagihan->getNominal();

        $data['bulan'] = $request->bulan;
        $data['tahun'] = $request->tahun;
        $data['tahun_ajaran'] = $request->tahun_ajaran;

        return Tagihan::create($data);
    }
}
