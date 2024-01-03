<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
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
        $auth = Auth::user();
        if ($auth) {
            $userId = Auth::user()->id;
            $user = User::findOrFail($userId);

            if ($user && ($user->role == 'pengguna' || $user->role == 'petugas')) {
                // Jika user merupakan pengguna atau petugas
                if (!$user->hasVerifiedEmail()) {
                    // Jika email belum diverifikasi, arahkan ke rute verifikasi email
                    return redirect()->route('verification.notice', $user->id);
                }

                // Jika email sudah diverifikasi, lanjutkan ke halaman yang diinginkan
                return $next($request);
            }
            return redirect('/login');
        }
        return redirect('/login');
    }
}
