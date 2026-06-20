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
        // Validasi Ketat Sesuai Logika Sistem
        $request->validate([
            'judul'            => 'required|string|max:255',
            'isi'              => 'required|string',
            'tanggal_mulai'    => 'required|date',
            'target'           => 'required|string|max:100',
            'kelas_target'     => 'required_if:target,Kelas Tertentu',
            'id_siswa_target'  => 'required_if:target,Siswa Tertentu',
            'status'           => 'required|in:Aktif,Draft,Nonaktif',
        ], [
            'kelas_target.required_if'       => 'Kelas wajib dipilih jika target pengumuman untuk Kelas Tertentu.',
            'id_siswa_target.required_if'    => 'Siswa wajib dipilih jika target pengumuman untuk Siswa Tertentu.'
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

        $tanggal_mulai = \Carbon\Carbon::parse($request->tanggal_mulai);
        $tanggal_selesai = $tanggal_mulai->copy()->addMonth();

        Pengumuman::create([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tanggal_mulai'   => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
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

        // Validasi Ketat Sesuai Logika Sistem
        $request->validate([
            'judul'            => 'required|string|max:255',
            'isi'              => 'required|string',
            'tanggal_mulai'    => 'required|date',
            'target'           => 'required|string|max:100',
            'kelas_target'     => 'required_if:target,Kelas Tertentu',
            'id_siswa_target'  => 'required_if:target,Siswa Tertentu',
            'status'           => 'required|in:Aktif,Draft,Nonaktif',
        ], [
            'kelas_target.required_if'       => 'Kelas wajib dipilih jika target pengumuman untuk Kelas Tertentu.',
            'id_siswa_target.required_if'    => 'Siswa wajib dipilih jika target pengumuman untuk Siswa Tertentu.'
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

        $tanggal_mulai = \Carbon\Carbon::parse($request->tanggal_mulai);
        $tanggal_selesai = $tanggal_mulai->copy()->addMonth();

        $pengumuman->update([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tanggal_mulai'   => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
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
