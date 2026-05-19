<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar pengumuman
     */
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Menampilkan form tambah pengumuman
     */
    public function create()
    {
        $kelas = DB::table('kelas')
            ->orderBy('nama_kelas', 'asc')
            ->get();

        $siswa = DB::table('siswa')
            ->where('status_siswa', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.pengumuman.create', compact('kelas', 'siswa'));
    }

    /**
     * Menyimpan pengumuman baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'isi'              => 'required|string',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'nullable|date|after_or_equal:tanggal_mulai',
            'target'           => 'required|string|max:100',
            'status'           => 'required|in:Aktif,Draft,Nonaktif',
        ]);

        // Jika target kelas tertentu, simpan nama kelas sebagai target
        $target = $request->target;

        if ($request->target === 'Kelas Tertentu' && $request->kelas_target) {
            $target = 'Kelas: ' . $request->kelas_target;
        }

        // Jika target siswa tertentu, ambil nama siswa
        if ($request->target === 'Siswa Tertentu' && $request->id_siswa_target) {
            $siswa = DB::table('siswa')
                ->where('id_siswa', $request->id_siswa_target)
                ->first();

            if ($siswa) {
                $target = 'Siswa: ' . $siswa->nama;
            }
        }

        Pengumuman::create([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'target'          => $target,
            'status'          => $request->status,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pengumuman
     */
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $kelas = DB::table('kelas')
            ->orderBy('nama_kelas', 'asc')
            ->get();

        $siswa = DB::table('siswa')
            ->where('status_siswa', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.pengumuman.edit', compact(
            'pengumuman',
            'kelas',
            'siswa'
        ));
    }

    /**
     * Memperbarui data pengumuman
     */
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul'            => 'required|string|max:255',
            'isi'              => 'required|string',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'nullable|date|after_or_equal:tanggal_mulai',
            'target'           => 'required|string|max:100',
            'status'           => 'required|in:Aktif,Draft,Nonaktif',
        ]);

        $target = $request->target;

        if ($request->target === 'Kelas Tertentu' && $request->kelas_target) {
            $target = 'Kelas: ' . $request->kelas_target;
        }

        if ($request->target === 'Siswa Tertentu' && $request->id_siswa_target) {
            $siswa = DB::table('siswa')
                ->where('id_siswa', $request->id_siswa_target)
                ->first();

            if ($siswa) {
                $target = 'Siswa: ' . $siswa->nama;
            }
        }

        $pengumuman->update([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'target'          => $target,
            'status'          => $request->status,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Menghapus pengumuman
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
