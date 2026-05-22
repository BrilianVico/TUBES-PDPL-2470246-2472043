<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrtuAuthController extends Controller
{
    /**
     * Menampilkan halaman login orang tua
     */
    public function showLoginForm()
    {
        return view('auth.login-ortu');
    }

    /**
     * Proses login orang tua
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $wali = DB::table('wali_murid')
            ->where('username', $request->username)
            ->first();

        if (!$wali) {
            return back()
                ->withInput()
                ->with('error', 'Username tidak ditemukan.');
        }

        if (!Hash::check($request->password, $wali->password_hash)) {
            return back()
                ->withInput()
                ->with('error', 'Password salah.');
        }

        session([
            'ortu_logged_in' => true,
            'id_walimurid'   => $wali->id_walimurid,
            'username_wali'  => $wali->username,
            'nama_wali'      => $wali->nama ?? $wali->username,
        ]);

        return redirect()->route('dashboard.ortu');
    }

    /**
     * Logout orang tua
     */
    public function logout()
    {
        session()->forget([
            'ortu_logged_in',
            'id_walimurid',
            'username_wali',
            'nama_wali',
        ]);

        return redirect()->route('home');
    }

    /**
     * Menampilkan halaman cek akun
     */
    public function showCekAkun()
    {
        return view('auth.cek-akun-ortu');
    }

    /**
     * Proses cek akun
     */
    public function cekAkun(Request $request)
    {
        $request->validate([
            'nama_wali' => 'required',
            'nama_anak' => 'required',
        ]);

        $dataAkun = DB::table('wali_murid as w')
            ->join('siswa as s', 'w.id_walimurid', '=', 's.id_walimurid')
            ->where('w.nama', $request->nama_wali)
            ->where('s.nama', $request->nama_anak)
            ->select(
                'w.username as nik',
                's.nis'
            )
            ->orderBy('s.nis')
            ->first();

        if (!$dataAkun) {
            return back()
                ->with('error', 'Data tidak ditemukan. Pastikan nama lengkap benar.')
                ->withInput();
        }

        return back()
            ->with('data_akun', $dataAkun)
            ->withInput();
    }

    /**
     * Menampilkan halaman lupa password
     */
    public function showForgotPassword()
    {
        return view('auth.lupa-password-ortu');
    }

    /**
     * Reset password menjadi NIS anak
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'nik'       => 'required',
            'nama_anak' => 'required',
        ]);

        $data = DB::table('wali_murid as w')
            ->join('siswa as s', 'w.id_walimurid', '=', 's.id_walimurid')
            ->where('w.username', $request->nik)
            ->where('s.nama', $request->nama_anak)
            ->select(
                'w.id_walimurid',
                's.nis'
            )
            ->orderBy('s.nis')
            ->first();

        if (!$data) {
            return back()
                ->with('error', 'Verifikasi gagal. NIK atau nama anak tidak cocok.')
                ->withInput();
        }

        DB::table('wali_murid')
            ->where('id_walimurid', $data->id_walimurid)
            ->update([
                'password_hash' => Hash::make((string) $data->nis),
            ]);

        return back()->with(
            'success',
            'Verifikasi berhasil! Password Anda telah di-reset menjadi NIS anak Anda (' . $data->nis . ').'
        );
    }

    /**
     * Menampilkan halaman ubah password
     */
    public function showChangePassword()
    {
        return view('ortu.change-password');
    }

    /**
     * Proses ubah password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6',
            'konfirmasi'    => 'required|same:password_baru',
        ], [
            'konfirmasi.same'   => 'Konfirmasi password baru tidak cocok.',
            'password_baru.min' => 'Password baru minimal 6 karakter.',
        ]);

        $idWali = session('id_walimurid');

        $wali = DB::table('wali_murid')
            ->where('id_walimurid', $idWali)
            ->first();

        if (!$wali) {
            return back()->withErrors([
                'password_lama' => 'Data wali murid tidak ditemukan.'
            ]);
        }

        if (!Hash::check($request->password_lama, $wali->password_hash)) {
            return back()->withErrors([
                'password_lama' => 'Password saat ini tidak sesuai.'
            ]);
        }

        DB::table('wali_murid')
            ->where('id_walimurid', $idWali)
            ->update([
                'password_hash' => Hash::make($request->password_baru),
            ]);

        return redirect()
            ->route('ortu.change-password')
            ->with('success', 'Password berhasil diperbarui.');
    }
}
