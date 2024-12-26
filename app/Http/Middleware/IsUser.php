<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah pengguna sudah login dan memiliki peran user
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request); // Izinkan akses jika user
        }

        // Jika bukan user, redirect atau abort
        return redirect()->route('/')->with('error', 'You do not have access for this feature.');
    }
}
