<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSiswa
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ngecek: Apakah user INI BUKAN siswa yang sudah login?
        if (!Auth::guard('siswa')->check()) {
            // Kalau bukan, tendang balik ke form utama (login siswa)
            return redirect('/')->withErrors([
                'akses' => 'Kamu harus memasukkan NIS dulu untuk melihat halaman ini.',
            ]);
        }

        return $next($request);
    }
}