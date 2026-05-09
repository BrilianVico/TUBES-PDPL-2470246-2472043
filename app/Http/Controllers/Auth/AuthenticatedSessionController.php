<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login admin.
     */
    public function create(): View
    {
        return view('auth.login_admin');
    }

    /**
     * Proses login admin menggunakan tabel `admin`.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cari admin berdasarkan username
        // (username di database diisi admin@email.com)
        $admin = Admin::where('username', $request->email)->first();

        // Cek apakah admin ditemukan dan password sesuai
        if ($admin && Hash::check($request->password, $admin->password_hash)) {

            // Simpan session admin
            session([
                'admin_id' => $admin->id_admin,
                'admin_username' => $admin->username,
            ]);

            // Regenerate session
            $request->session()->regenerate();

            // Redirect ke dashboard
            return redirect()->intended(route('dashboard'));
        }

        // Jika gagal login
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout admin.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Hapus session admin
        $request->session()->forget([
            'admin_id',
            'admin_username',
        ]);

        // Hapus seluruh session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke landing page
        return redirect('/');
    }
}
