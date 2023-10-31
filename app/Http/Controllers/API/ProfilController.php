<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function getProfil()
    {
        try {
            $user = Auth::user();
            return response()->json(['message' => 'Berhasil mengambil data profil', 'data' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal mengambil data profil', 'error' => $th], 500);
        }
    }

    public function editProfil(Request $request)
    {
        try {
            User::where('id', auth()->user()->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json(['message' => 'Berhasil mengedit profil'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal mengedit profil', 'error' => $th], 500);
        }
    }
}
