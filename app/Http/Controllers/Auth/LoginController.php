<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Notifications\VerifyEmail;

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


        $credentials = $request->only('email_or_username', 'password');

        // Cek apakah pengguna login menggunakan email atau username
        $field = filter_var($credentials['email_or_username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials[$field] = $credentials['email_or_username'];
        unset($credentials['email_or_username']);

        if (Auth::attempt($credentials)) {
            $userId = auth()->user()->id;
            // dd($userId);
            $user = User::findOrFail($userId);

            if ($user->role == 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            } elseif ($user->role == 'author' || $user->role == 'petugas') {
                // Check if the user has verified their email
                if (!$user->hasVerifiedEmail()) {
                    // Send email verification notification
                    $user->notify(new VerifyEmail);

                    // Redirect to the email verification page
                    return redirect()->route('verification.notice', $user->id);
                }

                // User has verified email, proceed to dashboard based on role
                $request->session()->regenerate();
                if ($user->role == 'author') {
                    return redirect()->intended('/dashboard/news');
                } elseif ($user->role == 'petugas') {
                    return redirect()->intended('/dashboard/laporan');
                }
            }
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
                return redirect()->route('laporan.index');
            } else {
                $data = [
                    'name' => $user->name,
                    'username' => $user->name . $user->id,
                    'email' => $user->email,
                ];
                session(['google_register_data' => $data]);
                return redirect()->route('redirectRegisterGoogle');
            }
        } catch (\Exception $e) {
            // Jika terjadi error, redirect kembali ke halaman login
            return redirect()->route('login');
        }
    }

    public function redirectRegisterGoogle()
    {
        $title = 'Pendaftaran';
        return view('auth.register-google', compact('title'));
    }

    public function registerGoogle(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);
        $data = session('google_register_data', []);
        $data['password'] = $request->password;

        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->email_verified_at =  now();
        $user->save();

        session()->forget('google_register_data');
        auth()->login($user);

        return redirect()->route('laporan.index');
    }
}
