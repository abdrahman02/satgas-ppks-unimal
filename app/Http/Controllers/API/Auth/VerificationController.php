<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\EmailVerificationNotification;

class VerificationController extends Controller
{
    public function verify($code)
    {
        $user = User::where('verification_code', $code)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->save();

            return response()->json(['message' => 'Verifikasi email berhasil!'], 200);
        }

        return response()->json(['message' => 'Kode verifikasi tidak valid.'], 400);
    }

    public function resend(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            // Generate dan simpan kode verifikasi acak 8 karakter
            $verificationCode = Str::random(8);
            $user->verification_code = $verificationCode;
            $user->save();

            // Kirim email verifikasi dengan kode baru
            $user->notify(new EmailVerificationNotification($verificationCode));

            return response()->json(['message' => 'Kode verifikasi baru telah dikirim.'], 200);
        }

        return response()->json(['message' => 'Email tidak ditemukan.'], 404);
    }
}
