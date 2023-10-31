<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginField = filter_var($request->email_or_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->email_or_username,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Email/username ataupun password salah']);
        }

        $user = $request->user();
        $token = $user->createToken('Token Name')->plainTextToken;

        // Lakukan pembaruan kolom remember_token pada tabel user
        $user->update(['remember_token' => $token]);

        return response()->json([
            'message' => 'Berhasil login!',
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            // Hapus semua token pengguna
            $user->tokens()->delete();
            // Setelah token dihapus, Anda dapat mengatur remember_token menjadi null
            $user->update(['remember_token' => null]);
            return response()->json(['message' => 'Berhasil logout dan menghapus token'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal logout', 'error' => $th], 500);
        }
    }

    public function register(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Registrasi berhasil!', 'data' => $user]);
    }
}
