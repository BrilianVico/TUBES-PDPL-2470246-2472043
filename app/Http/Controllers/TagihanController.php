<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Factories\TagihanFactory;
use App\Models\Tagihan;
use App\Abstracts\BeasiswaPersen;
use App\Abstracts\BeasiswaNominal;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = DB::table('tagihan as t')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->select(
                't.*',
                's.nis',
                's.nama'
            )
            ->orderBy('t.id_tagihan', 'desc')
            ->get();

        return view('admin.tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $siswa = DB::table('siswa')
            ->where('status_siswa', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.tagihan.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        if ($request->mode_generate == 'satu') {

            $request->validate([
                'id_siswa'      => 'required',
                'jenis_tagihan' => 'required',
                'bulan'         => 'required',
                'tahun'         => 'required',
                'tahun_ajaran'  => 'required',
            ]);

            $data = TagihanFactory::create(
                $request->jenis_tagihan,
                $request->id_siswa
            );

            $data['potongan_beasiswa'] = 0;

            $beasiswaAktif = DB::table('beasiswa_siswa as bs')
                ->join('beasiswa as b', 'bs.id_beasiswa', '=', 'b.id_beasiswa')
                ->where('bs.id_siswa', $request->id_siswa)
                ->where('bs.status', 'AKTIF')
                ->where('b.status', 'AKTIF')
                ->first();

            if ($beasiswaAktif) {

                if (
                    strtoupper($beasiswaAktif->berlaku_untuk) == 'SEMUA'
                    ||
                    strtoupper($beasiswaAktif->berlaku_untuk) == strtoupper($request->jenis_tagihan)
                ) {

                    if ($beasiswaAktif->jenis_potongan == 'PERSEN') {
                        $beasiswa = new BeasiswaPersen(
                            $beasiswaAktif->nilai_potongan
                        );
                    } else {
                        $beasiswa = new BeasiswaNominal(
                            $beasiswaAktif->nilai_potongan
                        );
                    }

                    $potongan = $beasiswa->hitungPotongan(
                        $data['nominal']
                    );

                    $data['potongan_beasiswa'] = $potongan;
                }
            }

            $data['bulan'] = $request->bulan;
            $data['tahun'] = $request->tahun;
            $data['tahun_ajaran'] = $request->tahun_ajaran;
            $data['status'] = 'BELUM';

            Tagihan::create($data);

        } else {

            $request->validate([
                'jenis_tagihan' => 'required',
                'bulan'         => 'required',
                'tahun'         => 'required',
                'tahun_ajaran'  => 'required',
            ]);

            $siswaAktif = DB::table('siswa')
                ->where('status_siswa', 'Aktif')
                ->get();

            foreach ($siswaAktif as $siswa) {

                $data = TagihanFactory::create(
                    $request->jenis_tagihan,
                    $siswa->id_siswa
                );

                $data['potongan_beasiswa'] = 0;

                $beasiswaAktif = DB::table('beasiswa_siswa as bs')
                    ->join('beasiswa as b', 'bs.id_beasiswa', '=', 'b.id_beasiswa')
                    ->where('bs.id_siswa', $siswa->id_siswa)
                    ->where('bs.status', 'AKTIF')
                    ->where('b.status', 'AKTIF')
                    ->first();

                if ($beasiswaAktif) {

                    if (
                        strtoupper($beasiswaAktif->berlaku_untuk) == 'SEMUA'
                        ||
                        strtoupper($beasiswaAktif->berlaku_untuk) == strtoupper($request->jenis_tagihan)
                    ) {

                        if ($beasiswaAktif->jenis_potongan == 'PERSEN') {
                            $beasiswa = new BeasiswaPersen(
                                $beasiswaAktif->nilai_potongan
                            );
                        } else {
                            $beasiswa = new BeasiswaNominal(
                                $beasiswaAktif->nilai_potongan
                            );
                        }

                        $potongan = $beasiswa->hitungPotongan(
                            $data['nominal']
                        );

                        $data['potongan_beasiswa'] = $potongan;
                    }
                }

                $data['bulan'] = $request->bulan;
                $data['tahun'] = $request->tahun;
                $data['tahun_ajaran'] = $request->tahun_ajaran;
                $data['status'] = 'BELUM';

                Tagihan::create($data);
            }
        }

        return redirect()
            ->route('admin.tagihan.index')
            ->with('success', 'Tagihan berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa'      => 'required',
            'jenis_tagihan' => 'required',
            'nominal'       => 'required|numeric',
            'bulan'         => 'required',
            'tahun'         => 'required',
            'tahun_ajaran'  => 'required',
            'status'        => 'required',
        ]);

        $tagihan = Tagihan::findOrFail($id);

        $tagihan->update([
            'id_siswa'          => $request->id_siswa,
            'jenis_tagihan'     => $request->jenis_tagihan,
            'nominal'           => $request->nominal,
            'bulan'             => $request->bulan,
            'tahun'             => $request->tahun,
            'tahun_ajaran'      => $request->tahun_ajaran,
            'status'            => $request->status,
            'potongan_beasiswa' => $request->potongan_beasiswa ?? 0,
        ]);

        return redirect()
            ->route('admin.tagihan.index')
            ->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();

        return redirect()
            ->route('admin.tagihan.index')
            ->with('success', 'Tagihan berhasil dihapus.');
    }
}
