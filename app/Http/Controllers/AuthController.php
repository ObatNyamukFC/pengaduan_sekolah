<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class AuthController extends Controller
{
    // ==========================================
    // LOGIKA LOGIN ADMIN
    // ==========================================
    public function prosesLoginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Laravel akan otomatis mencari kolom 'username' dan 'password' di tabel admin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard'); 
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    // ==========================================
    // LOGIKA LOGIN SISWA 
    // ==========================================
    public function prosesLoginSiswa(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric'
        ]);

        $siswa = Siswa::where('nis', $request->nis)->first();

        if ($siswa) {
            Auth::guard('siswa')->login($siswa);
            $request->session()->regenerate();
            return redirect()->intended('/siswa/aspirasi'); 
        }

        return back()->withErrors([
            'nis' => 'NIS tidak terdaftar di sistem.',
        ]);
    }

    // ==========================================
    // LOGIKA LOGOUT
    // ==========================================
    public function logout(Request $request)
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        } elseif(Auth::guard('siswa')->check()){
            Auth::guard('siswa')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}