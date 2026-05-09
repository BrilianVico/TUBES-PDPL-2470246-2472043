<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = DB::table('admin')
            ->where('username', $request->username)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password_hash)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id_admin,
                'admin_username' => $admin->username,
            ]);

            return redirect()->route('dashboard');
        }

        return back()
            ->withInput()
            ->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }
}
