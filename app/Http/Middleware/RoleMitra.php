<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMitra
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'mitra') {
            return redirect('/')->withErrors(['msg' => 'Akses ditolak. Halaman ini hanya untuk Mitra Tani!']);
        }

        return $next($request);
    }
}
