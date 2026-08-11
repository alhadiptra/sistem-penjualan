<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Cek apakah user memiliki role yang diizinkan
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika role user tidak ada di daftar yang diizinkan, tampilkan error 403
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
