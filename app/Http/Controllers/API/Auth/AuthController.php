<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Notifications\EmailVerificationNotification;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $loginField = filter_var($request->email_or_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $credentials = [
                $loginField => $request->email_or_username,
                'password' => $request->password,
            ];

            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Email/username ataupun password salah'], 400);
            }

            $user = $request->user();
            $token = $user->createToken('Token Name')->plainTextToken;

            // Lakukan pembaruan kolom remember_token pada tabel user
            $user->update(['remember_token' => $token]);
            $user = $user->biodata;

            return response()->json([
                'message' => 'Berhasil login!',
                'token' => $token,
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal logout', 'error' => $e], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            // Validasi data yang diterima dari klien
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|string|same:password',
            ]);

            // Buat instance User
            $user = new User();
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $verificationCode = Str::random(8);
            $user->verification_code = $verificationCode;
            $user->save();

            // Kirim email verifikasi dengan kode
            $user->notify(new EmailVerificationNotification($verificationCode));


            // Kirim respons dengan pesan berhasil dan data pengguna yang terdaftar
            return response()->json(['message' => 'Registrasi berhasil! Periksa email Anda untuk verifikasi.', 'data' => $user], 201);
        } catch (ValidationException $e) {
            // Tangani kesalahan validasi dengan mengirim respons error dengan status 400 (Bad Request)
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            // Tangani kesalahan dengan mengirim respons error
            return response()->json(['message' => 'Registrasi gagal', 'error' => $e->getMessage()], 500);
        }
    }

    public function googleSignInCheckEmail(Request $request)
    {
        try {
            $name = $request->input('name');
            $username = $request->input('username');
            $email = $request->input('email');
            $dataUser = [
                'name' => $name,
                'username' => $username,
                'email' => $email,
            ];
            $existingUser = User::where('email', $email)->first();
            if ($existingUser) {
                $token = $existingUser->createToken('Token Name')->plainTextToken;
                // Lakukan pembaruan kolom remember_token pada tabel user
                $existingUser->update(['remember_token' => $token]);
                return response()->json(['message' => 'Email telah terdata', 'token' => $token, 'success' => true], 200);
            } else {
                return response()->json(['message' => 'Email belum terdata', 'success' => false, 'dataUser' => $dataUser], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ada kesalahan!', 'error' => $e->getMessage()], 500);
        }
    }

    public function registerGoogleSignIn(Request $request)
    {
        try {
            // Validasi data yang diterima dari klien
            $request->validate([
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|string|same:password',
            ]);

            // Buat instance User
            $user = new User();
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->email_verified_at = now();
            $user->save();
            $token = $user->createToken('Token Name')->plainTextToken;
            // Lakukan pembaruan kolom remember_token pada tabel user
            $user->update(['remember_token' => $token]);
            $user = $user->biodata;

            // Kirim respons dengan pesan berhasil dan data pengguna yang terdaftar
            return response()->json(['message' => 'Registrasi berhasil!', 'data' => $user, 'token' => $token], 201);
        } catch (ValidationException $e) {
            // Tangani kesalahan validasi dengan mengirim respons error dengan status 400 (Bad Request)
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            // Tangani kesalahan dengan mengirim respons error
            return response()->json(['message' => 'Registrasi gagal', 'error' => $e->getMessage()], 500);
        }
    }
}
