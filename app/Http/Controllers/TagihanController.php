<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Factories\TagihanFactory;
use App\Models\Tagihan;
use App\Decorators\TagihanDasar;
use App\Decorators\BeasiswaDecorator;

class TagihanController extends Controller
{
    /**
     * Menampilkan daftar tagihan
     */
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

    /**
     * Menampilkan form tambah tagihan
     */
    public function create()
    {
        $siswa = DB::table('siswa')
            ->where('status_siswa', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.tagihan.create', compact('siswa'));
    }

    /**
     * Menyimpan tagihan baru
     * Menggunakan Factory Pattern + Decorator Pattern
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa'      => 'required',
            'jenis_tagihan' => 'required',
            'bulan'         => 'required',
            'tahun'         => 'required',
            'tahun_ajaran'  => 'required',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Factory Pattern
        |--------------------------------------------------------------------------
        | Membuat data tagihan otomatis berdasarkan jenis tagihan.
        |--------------------------------------------------------------------------
        */
        $data = TagihanFactory::create(
            $request->jenis_tagihan,
            $request->id_siswa
        );

        /*
        |--------------------------------------------------------------------------
        | Decorator Pattern
        |--------------------------------------------------------------------------
        | Jika siswa mendapatkan beasiswa, nominal dikurangi otomatis.
        |--------------------------------------------------------------------------
        */
        $tagihan = new TagihanDasar($data['nominal']);

        if ($request->beasiswa == 1) {
            $tagihan = new BeasiswaDecorator($tagihan);
            $data['potongan_beasiswa'] = 100000;
        } else {
            $data['potongan_beasiswa'] = 0;
        }

        // Nominal akhir setelah decorator
        $data['nominal'] = $tagihan->getNominal();

        // Tambahan field dari form
        $data['bulan'] = $request->bulan;
        $data['tahun'] = $request->tahun;
        $data['tahun_ajaran'] = $request->tahun_ajaran;
        $data['status'] = 'Belum Lunas';

        // Simpan ke database
        Tagihan::create($data);

        return redirect()
            ->route('admin.tagihan.index')
            ->with('success', 'Tagihan berhasil dibuat.');
    }

    /**
     * Menampilkan form edit tagihan
     */
    public function edit($id)
    {
        $tagihan = Tagihan::findOrFail($id);

        $siswa = DB::table('siswa')
            ->where('status_siswa', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.tagihan.edit', compact('tagihan', 'siswa'));
    }

    /**
     * Update tagihan
     */
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
            'id_siswa'           => $request->id_siswa,
            'jenis_tagihan'      => $request->jenis_tagihan,
            'nominal'            => $request->nominal,
            'bulan'              => $request->bulan,
            'tahun'              => $request->tahun,
            'tahun_ajaran'       => $request->tahun_ajaran,
            'status'             => $request->status,
            'potongan_beasiswa'  => $request->potongan_beasiswa ?? 0,
        ]);

        return redirect()
            ->route('admin.tagihan.index')
            ->with('success', 'Tagihan berhasil diperbarui.');
    }

    /**
     * Hapus tagihan
     */
    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();

        return redirect()
            ->route('admin.tagihan.index')
            ->with('success', 'Tagihan berhasil dihapus.');
    }
}
