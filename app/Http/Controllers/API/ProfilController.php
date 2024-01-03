<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfilController extends Controller
{
    public function getUser()
    {
        try {
            $user = Auth::user();
            return response()->json(['message' => 'Berhasil mengambil data akun', 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengambil data akun', 'error' => $e], 500);
        }
    }

    public function editUser(Request $request)
    {
        try {
            $user = auth()->user();
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ]);
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);
            return response()->json(['message' => 'Berhasil mengedit akun'], 200);
        } catch (ValidationException $e) {
            // Tangani kesalahan validasi dengan mengirim respons error dengan status 400 (Bad Request)
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengedit akun', 'error' => $e], 500);
        }
    }

    public function ubahPassword(Request $request)
    {
        try {
            $id = auth()->user()->id;
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8',
                'confirmation_password' => 'required|string|min:8|same:password',
            ]);

            $user = User::findOrFail($id);

            // Cek apakah password lama sesuai dengan yang ada di database
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['message' => 'Validasi Password', 'errors' => 'Password lama tidak sesuai.'], 400);
            }

            // Update password baru
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['message' => 'Password berhasil diubah!'], 200);
        } catch (ValidationException $e) {
            // Tangani kesalahan validasi dengan mengirim respons error dengan status 400 (Bad Request)
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengubah password', 'error' => $e], 500);
        }
    }

    public function checkBiodata()
    {
        $user = Auth::user();

        if (!$user || empty($user->biodata)) {
            return response()->json(['message' => 'Silakan isi biodata terlebih dahulu', 'status' => false], 403);
        }

        return response()->json(['message' => 'Biodata sudah diisi', 'status' => true], 200);
    }


    public function getBio()
    {
        try {
            $idUser = Auth::user()->id;
            $bioUser = Biodata::where('user_id', $idUser)->first();
            if ($bioUser) {
                return response()->json(['message' => 'Berhasil mengambil data biodata', 'bioUser' => $bioUser], 200);
            } else if (!$bioUser) {
                return response()->json(['message' => 'Biodata tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengambil data biodata', 'error' => $e], 500);
        }
    }

    public function editBio(Request $request)
    {
        try {
            $idUser = Auth::user()->id;
            $bioUser = Biodata::where('user_id', $idUser)->first();
            if ($bioUser) {
                $bioUser->nip_nim_nik = $request->nip_nim_nik;
                $bioUser->status = $request->status;
                $bioUser->tempat_lahir = $request->tempat_lahir;
                $bioUser->tanggal_lahir = $request->tanggal_lahir;
                $bioUser->jenis_kelamin = $request->jenis_kelamin;
                $bioUser->no_telepon = $request->no_telepon;
                $bioUser->alamat = $request->alamat;
                $bioUser->update();

                return response()->json(['message' => 'Berhasil mengedit biodata'], 200);
            } else {
                $biodata = new Biodata();
                $biodata->nip_nim_nik = $request->nip_nim_nik;
                $biodata->status = $request->status;
                $biodata->tempat_lahir = $request->tempat_lahir;
                $biodata->tanggal_lahir = $request->tanggal_lahir;
                $biodata->jenis_kelamin = $request->jenis_kelamin;
                $biodata->no_telepon = $request->no_telepon;
                $biodata->alamat = $request->alamat;
                $biodata->user_id = $idUser;
                $biodata->save();
                return response()->json(['message' => 'Berhasil mengedit biodata'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengedit biodata', 'error' => $e], 500);
        }
    }
}
