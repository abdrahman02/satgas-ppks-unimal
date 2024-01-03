<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Notifications\VerifyEmail;

class RegistrationController extends Controller
{
    public function index()
    {
        $title = 'Registrasi';
        return view('auth.register', compact('title'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'username' => 'required|string|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/u|max:255|unique:users,username',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed'
            ],
            [
                'username.regex' => 'Username harus gabungan huruf & angka (Dapat menggunakan karakter spesial).',
            ]
        );

        // Lakukan sesuatu dengan data yang telah divalidasi, misalnya menyimpan ke database
        $user = new User();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        $user->notify(new VerifyEmail);

        // Redirect atau berikan response sesuai kebutuhan Anda
        return redirect()->route('verification.notice', $user->id);
    }

    public function update(Request $request, string $id)
    {
        if ($request->has('username') && $request->has('email')) {
            $request->validate([
                'username' => 'required|string|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/u|max:255|unique:users,username,' . $id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            ],
            [
                'username.regex' => 'Username harus gabungan huruf & angka (Dapat menggunakan karakter spesial).',
            ]
        );

            $user = User::findOrFail($id);
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            return redirect()->back()->with('success', 'Email dan username berhasil diubah.');
        }

        if ($request->has('current_password') && $request->has('password')) {
            // Validasi input sesuai kebutuhan
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::findOrFail($id);

            // Cek apakah password lama sesuai dengan yang ada di database
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }

            // Update password baru
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Redirect atau kirim response berhasil mengubah password
            return redirect()->back()->with('success', 'Password berhasil diubah.');
        }
    }
}
