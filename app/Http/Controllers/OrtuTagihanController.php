<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrtuTagihanController extends Controller
{
    /**
     * Menampilkan daftar tagihan yang belum lunas
     */
    public function index()
    {
        $idWali = session('id_walimurid');

        $tagihan = DB::table('tagihan as t')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->where('s.id_walimurid', $idWali)
            ->where('t.status', 'BELUM')
            ->select(
                't.*',
                's.nama as nama_siswa',
                's.nis'
            )
            ->orderBy('t.id_tagihan', 'desc')
            ->get();

        return view('ortu.tagihan', compact('tagihan'));
    }

    /**
     * Menampilkan form upload bukti transfer
     */
    public function showBayarForm($id)
    {
        $tagihan = DB::table('tagihan as t')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->where('t.id_tagihan', $id)
            ->select(
                't.*',
                's.nama as nama_siswa',
                's.nis'
            )
            ->first();

        if (!$tagihan) {
            abort(404);
        }

        return view('ortu.bayar-tagihan', compact('tagihan'));
    }

    /**
     * Menyimpan pembayaran dengan bukti transfer
     */
    public function submitPembayaran(Request $request, $id)
    {
        $request->validate([
            'tanggal_bayar' => 'required|date',
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string',
        ]);

        $file = $request->file('bukti_transfer');

        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->storeAs(
            'bukti-transfer',
            $filename,
            'public'
        );

        $tagihan = DB::table('tagihan')
            ->where('id_tagihan', $id)
            ->first();

        DB::table('pembayaran')->insert([
            'id_tagihan' => $id,
            'id_walimurid' => session('id_walimurid'),
            'nominal_bayar' => $tagihan->nominal,
            'status_bayar' => 'BELUM',
            'tanggal_bayar' => $request->tanggal_bayar,
            'bukti_transfer' => $filename,
            'catatan' => $request->catatan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tagihan')
            ->where('id_tagihan', $id)
            ->update([
                'status' => 'PROSES'
            ]);

        return redirect()
            ->route('ortu.tagihan.index')
            ->with(
                'success',
                'Bukti transfer berhasil dikirim. Menunggu verifikasi admin.'
            );
    }

    /**
     * Riwayat pembayaran orang tua
     */

    public function riwayat()
    {
        $idWali = session('id_walimurid');

        $riwayat = DB::table('pembayaran as p')
            ->join('tagihan as t', 'p.id_tagihan', '=', 't.id_tagihan')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->where('p.id_walimurid', $idWali)
            ->select(
                'p.*',
                't.jenis_tagihan',
                't.bulan',
                't.tahun',
                's.nama as nama_siswa',
                's.nis'
            )
            ->orderBy('p.id_pembayaran', 'desc')
            ->get();

        return view('ortu.riwayat', compact('riwayat'));
    }
}


