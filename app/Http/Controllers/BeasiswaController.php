<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\BeasiswaSiswa;
use App\Models\PengajuanBeasiswa;
use Illuminate\Http\Request;

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
            'nama_beasiswa' => 'required',
            'deskripsi' => 'required',
            'persentase_potongan' => 'required|numeric|min:1|max:100',
            'kuota' => 'required|integer',
            'status' => 'required'
        ]);

        Beasiswa::create([
            'nama_beasiswa' => $request->nama_beasiswa,
            'jenis' => 'POTONGAN',
            'nominal' => 0,
            'deskripsi' => $request->deskripsi,
            'persentase_potongan' => $request->persentase_potongan,
            'kuota' => $request->kuota,
            'status' => strtoupper($request->status)
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
            'nama_beasiswa' => 'required',
            'deskripsi' => 'required',
            'persentase_potongan' => 'required|numeric|min:1|max:100',
            'kuota' => 'required|integer',
            'status' => 'required'
        ]);

        $beasiswa->update([
            'nama_beasiswa' => $request->nama_beasiswa,
            'jenis' => 'POTONGAN',
            'nominal' => 0,
            'deskripsi' => $request->deskripsi,
            'persentase_potongan' => $request->persentase_potongan,
            'kuota' => $request->kuota,
            'status' => strtoupper($request->status)
        ]);

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Beasiswa::findOrFail($id)->delete();

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | PENGAJUAN BEASISWA
    |--------------------------------------------------------------------------
    */

    public function pengajuan()
    {
        $pengajuan = PengajuanBeasiswa::orderBy('id_pengajuan', 'desc')->get();

        return view('admin.beasiswa.pengajuan', compact('pengajuan'));
    }

    public function approvePengajuan($id)
    {
        $pengajuan = PengajuanBeasiswa::findOrFail($id);

        // ubah status pengajuan
        $pengajuan->update([
            'status' => 'Diterima'
        ]);

        // hubungkan siswa dengan program beasiswa
        $cek = BeasiswaSiswa::where('id_siswa', $pengajuan->id_siswa)
            ->where('id_beasiswa', 1)
            ->first();

        if (!$cek) {
            BeasiswaSiswa::create([
                'id_siswa' => $pengajuan->id_siswa,
                'id_beasiswa' => $pengajuan->id_beasiswa
            ]);
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
