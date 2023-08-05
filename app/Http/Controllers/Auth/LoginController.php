<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_username' => 'required|string',
            'password' => 'required|string',
        ]);

        // if ($validator->fails()) {
        //     return back()->with('loginError', 'Email/username atau password salah!')->withErrors($validator);
        // }

        $credentials = $request->only('email_or_username', 'password');

        // Cek apakah pengguna login menggunakan email atau username
        $field = filter_var($credentials['email_or_username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials[$field] = $credentials['email_or_username'];
        unset($credentials['email_or_username']);

        if (Auth::attempt($credentials)) {
            // Jika login berhasil
            return redirect()->route('dashboard.index')->with('success', 'Berhasil masuk!');
        } else {
            // Jika login gagal
            return back()->with('loginError', 'Email/username atau password salah!')->withErrors($validator);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // dd($user);
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                // Jika akun dengan email ini sudah ada, maka langsung login
                auth()->login($existingUser);
                return redirect()->route('dashboard.index');
            } else {
                // Jika belum ada, buat akun baru
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->username = $user->name . $user->id;
                $newUser->email = $user->email;
                $newUser->password = Hash::make('password'); // Anda bisa memberikan password default
                $newUser->save();

                auth()->login($newUser);
                return redirect()->route('dashboard.index');
            }
        } catch (\Exception $e) {
            // Jika terjadi error, redirect kembali ke halaman login
            return redirect()->route('login');
        }
    }
}
