<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
}
