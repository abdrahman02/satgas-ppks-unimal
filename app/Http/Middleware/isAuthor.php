<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        if ($user && $user->role == 'author') {
            if (!$user->hasVerifiedEmail()) {
                // Jika email belum diverifikasi, arahkan ke rute verifikasi email
                return redirect()->route('verification.notice', $user->id);
            }
            // jika user adalah author, lanjutkan tujuan
            return $next($request);
        }
        // jika user bukan author, arahkan ke rute yang diinginkan
        return redirect('/');
    }
}
