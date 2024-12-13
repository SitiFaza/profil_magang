<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Coba login dengan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            // Regenerasi session
            $request->session()->regenerate();

            // Redirect ke dashboard
            return redirect()->intended('/dashboard');
        }

        // Gagal login, kembali ke halaman login dengan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Logout dari guard 'admin'
        Auth::guard('admin')->logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login');
    }
}
