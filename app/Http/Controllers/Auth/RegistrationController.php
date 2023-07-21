<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'identitas' => 'required|string|in:dosen,tenaga_pendidik,mahasiswa,masyarakat_umum',
            'no_hp' => 'required|string|max:20',
            'nip_nim_nik' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        // Lakukan sesuatu dengan data yang telah divalidasi, misalnya menyimpan ke database

        // Redirect atau berikan response sesuai kebutuhan Anda
    }
}
