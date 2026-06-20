<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Menampilkan semua pembayaran dari orang tua
     */
    public function index()
    {
        $pembayaran = DB::table('pembayaran as p')
            ->join('tagihan as t', 'p.id_tagihan', '=', 't.id_tagihan')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->select(
                'p.*',
                's.nis',
                's.nama',
                't.jenis_tagihan'
            )
            ->orderBy('p.id_pembayaran', 'desc')
            ->get();

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    /**
     * Approve pembayaran
     */
    public function approve($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Update status pembayaran
        $pembayaran->update([
            'status_bayar' => 'LUNAS',
            'tanggal_bayar' => now()->toDateString(),
        ]);

        // Update status tagihan
        DB::table('tagihan')
            ->where('id_tagihan', $pembayaran->id_tagihan)
            ->update([
                'status' => 'LUNAS'
            ]);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil disetujui.');
    }

    /**
     * Tolak pembayaran
     */
    public function reject($id_pembayaran)
    {
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);

        // 1. Ubah status jadi 'DITOLAK'
        $pembayaran->status_bayar = 'DITOLAK';
        $pembayaran->save();

        // 2. Penting: Ubah status tagihannya menjadi 'DITOLAK'
        // agar muncul kembali di dashboard orang tua dengan status ditolak
        $tagihan = Tagihan::findOrFail($pembayaran->id_tagihan);
        $tagihan->status = 'DITOLAK';
        $tagihan->save();

        return redirect()->back()->with('success', 'Pembayaran ditolak, tagihan kembali aktif.');
    }
}
