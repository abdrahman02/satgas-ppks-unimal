<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DashboardPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Petugas';
        $petugas = User::where('role', 'petugas')->latest()->paginate(15)->withQueryString();
        return view('backend.petugas.index', compact('title', 'petugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $user->role = 'petugas';
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        // Redirect atau berikan response sesuai kebutuhan Anda
        return back()->with('success', 'Sukses, 1 Akun berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'username' => 'required|string|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/u|max:255|unique:users,username,' . $id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed'
            ],
            [
                'username.regex' => 'Username harus gabungan huruf & angka (Dapat menggunakan karakter spesial).',
            ]
        );

        $user = User::findOrFail($id);

        // Cek apakah password lama sesuai dengan yang ada di database
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['new_password']);

        $user->save();

        // Redirect atau berikan response sesuai kebutuhan Anda
        return back()->with('success', 'Sukses, 1 Akun berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findorFail($id);
        $item->delete();

        return back()->with('success', 'Sukses, 1 Akun berhasil dihapus!');
    }
}
