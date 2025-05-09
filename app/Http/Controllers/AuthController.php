<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login untuk semua aktor.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan peran pengguna
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'siswa':
                    return redirect()->route('student.dashboard');
                case 'pembimbing_sekolah':
                    return redirect()->route('school.dashboard');
                case 'pembimbing_perusahaan':
                    return redirect()->route('company.dashboard');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    /**
     * Logout pengguna.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
