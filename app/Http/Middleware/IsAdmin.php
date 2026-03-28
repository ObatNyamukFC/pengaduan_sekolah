<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ngecek: Apakah user INI BUKAN admin yang sudah login?
        if (!Auth::guard('admin')->check()) {
            // Kalau bukan, tendang balik ke halaman login admin
            return redirect('/login-admin')->withErrors([
                'akses' => 'Stop! Silakan login sebagai admin terlebih dahulu.',
            ]);
        }

        // Kalau benar admin, silakan lewat
        return $next($request);
    }
}