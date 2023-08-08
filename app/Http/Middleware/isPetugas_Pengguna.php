<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isPetugas_Pengguna
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && ($user->role == 'pengguna' || $user->role == 'petugas')) {
            // jika user merupakan pengguna ataupun petugas, arahkan ke halaman yang diinginkan
            return $next($request);
        }
        return redirect('/');
    }
}
