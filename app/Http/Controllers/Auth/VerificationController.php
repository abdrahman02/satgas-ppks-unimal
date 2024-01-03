<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    // Fungsi untuk menangani verifikasi email
    public function verify(Request $request, $id)
    {
        // Proses verifikasi email
        // Ambil token dari URL
        $user = User::findOrFail($id);
        if ($user->hasVerifiedEmail()) {
            // Pengguna sudah diverifikasi, dapatkan pesan atau tindakan yang sesuai
            return redirect('/login')->with('loginError', 'Email sudah diverifikasi.');
        }
        // Verifikasi email pengguna
        $user->markEmailAsVerified();

        // Event Verified digunakan oleh Laravel untuk mengeksekusi tindakan tertentu setelah verifikasi email berhasil
        event(new Verified($user));

        // Autentikasi pengguna setelah verifikasi
        Auth::login($user);

        // Redirect ke halaman yang sesuai setelah verifikasi
        return redirect('/dashboard/laporan')->with('verified', true);
    }

    // Fungsi untuk menampilkan halaman verifikasi email
    public function show(Request $request, $id)
    {
        $title = 'Verifikasi Email';
        $user = User::findOrFail($id);
        // Tampilkan halaman verifikasi email
        return view('auth.verify', compact('title', 'user'));
    }

    // Fungsi untuk mengirim ulang email verifikasi
    public function resend(Request $request, $id)
    {
        // Proses pengiriman ulang email verifikasi
        $user = User::findOrFail($id);
        $user->sendEmailVerificationNotification();

        // Redirect ke halaman yang sesuai setelah pengiriman ulang email
        return back()->with('resent', 'Email verifikasi sudah dikirim kembali!');
    }
}
