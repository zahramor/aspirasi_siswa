<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
{
    // Cukup cek session saja, karena proteksi Guard sudah ada di Controller
    if (!session()->has('role') || (session('role') !== 'admin' && session('role') !== 'superadmin')) {
        return redirect('/login')->with('error', 'Akses ditolak!');
    }

    return $next($request);
}
}