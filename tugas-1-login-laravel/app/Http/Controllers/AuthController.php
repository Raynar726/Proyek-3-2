<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function autenthicate(Request $request) {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Cek kredensial pengguna
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        // Jika kredensial tidak valid, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'login_failed' => 'Username atau password salah.',
        ])->withInput();
    }

    // Halaman dashboard setelah login berhasil
    public function dashboard() {
        return view('dashboard');
    }

    // Logout pengguna
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
