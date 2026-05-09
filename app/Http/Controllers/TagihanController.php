<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factories\TagihanFactory;
use App\Models\Tagihan;

use App\Decorators\TagihanDasar;
use App\Decorators\BeasiswaDecorator;

class TagihanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa'      => 'required',
            'jenis_tagihan' => 'required',
            'bulan'         => 'required',
            'tahun'         => 'required',
            'tahun_ajaran'  => 'required'
        ]);

        // Factory Pattern
        $data = TagihanFactory::create(
            $request->jenis_tagihan,
            $request->id_siswa
        );

        // Decorator Pattern
        $tagihan = new TagihanDasar($data['nominal']);

        if ($request->beasiswa == 1) {
            $tagihan = new BeasiswaDecorator($tagihan);
            $data['potongan_beasiswa'] = 100000;
        } else {
            $data['potongan_beasiswa'] = 0;
        }

        $data['nominal'] = $tagihan->getNominal();

        // Tambah data request
        $data['bulan'] = $request->bulan;
        $data['tahun'] = $request->tahun;
        $data['tahun_ajaran'] = $request->tahun_ajaran;

        // Simpan DB
        Tagihan::create($data);

        return redirect()->back()
            ->with('success', 'Tagihan berhasil dibuat');
    }
}
