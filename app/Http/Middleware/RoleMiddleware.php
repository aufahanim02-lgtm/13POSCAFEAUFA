<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // jika belum login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // jika role tidak sesuai
        if (Auth::user()->role != $role) {
            return redirect('/login')->with('error', 'Akses ditolak! Anda tidak punya izin.');
        }

        return $next($request);
    }
}