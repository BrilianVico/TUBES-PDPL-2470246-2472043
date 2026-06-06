<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\BeasiswaSiswa;
use App\Models\PengajuanBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeasiswaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CRUD PROGRAM BEASISWA
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $beasiswa = Beasiswa::orderBy('id_beasiswa', 'desc')->get();

        return view('admin.beasiswa.index', compact('beasiswa'));
    }

    public function create()
    {
        return view('admin.beasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_beasiswa'   => 'required',
            'deskripsi'       => 'required',
            'jenis_potongan'  => 'required',
            'nilai_potongan'  => 'required|numeric|min:1',
            'berlaku_untuk'   => 'required',
            'kuota'           => 'required|integer|min:1',
            'status'          => 'required'
        ]);

        Beasiswa::create([
            'nama_beasiswa'       => $request->nama_beasiswa,
            'jenis'               => 'POTONGAN',
            'nominal'             => 0,
            'deskripsi'           => $request->deskripsi,
            'jenis_potongan'      => strtoupper($request->jenis_potongan),
            'nilai_potongan'      => $request->nilai_potongan,
            'berlaku_untuk'       => strtoupper($request->berlaku_untuk),
            'persentase_potongan' => 0,
            'kuota'               => $request->kuota,
            'status'              => strtoupper($request->status)
        ]);

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, $id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        $request->validate([
            'nama_beasiswa'   => 'required',
            'deskripsi'       => 'required',
            'jenis_potongan'  => 'required',
            'nilai_potongan'  => 'required|numeric|min:1',
            'berlaku_untuk'   => 'required',
            'kuota'           => 'required|integer|min:1',
            'status'          => 'required'
        ]);

        $beasiswa->update([
            'nama_beasiswa'       => $request->nama_beasiswa,
            'jenis'               => 'POTONGAN',
            'nominal'             => 0,
            'deskripsi'           => $request->deskripsi,
            'jenis_potongan'      => strtoupper($request->jenis_potongan),
            'nilai_potongan'      => $request->nilai_potongan,
            'berlaku_untuk'       => strtoupper($request->berlaku_untuk),
            'persentase_potongan' => 0,
            'kuota'               => $request->kuota,
            'status'              => strtoupper($request->status)
        ]);

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil diperbarui.');
    }

    /**
     * PERBAIKAN: Menghapus data relasi di tabel anak terlebih dahulu
     */
    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        // 1. Hapus semua data siswa yang mengambil beasiswa ini di tabel beasiswa_siswa
        BeasiswaSiswa::where('id_beasiswa', $id)->delete();

        // 2. Baru hapus data program beasiswanya
        $beasiswa->delete();

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa beserta relasi data siswa berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | PENGAJUAN BEASISWA
    |--------------------------------------------------------------------------
    */

    public function pengajuan()
    {
        $pengajuan = DB::table('pengajuan_beasiswa as p')
            ->join('siswa as s', 'p.id_siswa', '=', 's.id_siswa')
            ->join('beasiswa as b', 'p.id_beasiswa', '=', 'b.id_beasiswa')
            ->select(
                'p.*',
                's.nama',
                's.nis',
                'b.nama_beasiswa',
                'b.jenis_potongan',
                'b.nilai_potongan',
                'b.berlaku_untuk',
                'b.kuota'
            )
            ->orderBy('p.id_pengajuan', 'desc')
            ->get();

        return view('admin.beasiswa.pengajuan', compact('pengajuan'));
    }

    public function approvePengajuan($id)
    {
        $pengajuan = PengajuanBeasiswa::findOrFail($id);

        $beasiswa = Beasiswa::findOrFail(
            $pengajuan->id_beasiswa
        );

        if ($beasiswa->kuota <= 0) {

            return back()->with(
                'error',
                'Kuota beasiswa sudah habis.'
            );
        }

        // ubah status pengajuan
        $pengajuan->update([
            'status' => 'Diterima'
        ]);

        // hubungkan siswa dengan program beasiswa
        $cek = BeasiswaSiswa::where('id_siswa', $pengajuan->id_siswa)
            ->where('id_beasiswa', $pengajuan->id_beasiswa) // PERBAIKAN: diubah dari statis angka 1 ke dinamis sesuai id_beasiswa pengajuan
            ->first();

        if (!$cek) {

            BeasiswaSiswa::create([
                'id_siswa' => $pengajuan->id_siswa,
                'id_beasiswa' => $pengajuan->id_beasiswa,
                'status' => 'AKTIF'
            ]);

            // Kurangi kuota
            $beasiswa->decrement('kuota');
        }

        return back()->with(
            'success',
            'Pengajuan beasiswa berhasil disetujui.'
        );
    }

    public function rejectPengajuan($id)
    {
        $pengajuan = PengajuanBeasiswa::findOrFail($id);

        $pengajuan->update([
            'status' => 'Ditolak'
        ]);

        return back()->with(
            'success',
            'Pengajuan beasiswa berhasil ditolak.'
        );
    }
}
