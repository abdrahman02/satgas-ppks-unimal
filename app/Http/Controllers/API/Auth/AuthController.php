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

        return response()->json([
            'message' => 'Berhasil login!',
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'alert' => 'Berhasil logout!'
        ]);
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
