<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Profil';
        $user = Auth::user();
        // Ambil data jenis kelamin dari model User (atau Anda bisa ambil dari model Biodata)
        $statuses = [
            'Mahasiswa',
            'Dosen',
            'Tendik',
            'Masyarakat Umum'
        ];
        $jenisKelamins = [
            'Laki-Laki',
            'Perempuan'
        ];
        return view('backend.profile.index', compact('title', 'user', 'statuses', 'jenisKelamins'));
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
        //
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
        $request->validate([
            'name' => 'required|string|max:255',
            'nip_nim_nik' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'no_telepon' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        $biodata = $user->biodata;
        if (!$biodata) {
            $biodata = new Biodata();
            $biodata->user_id = $user->id;
        }

        $biodata->nip_nim_nik = $request->nip_nim_nik;
        $biodata->status = $request->status;
        $biodata->tempat_lahir = $request->tempat_lahir;
        $biodata->tanggal_lahir = $request->tanggal_lahir;
        $biodata->jenis_kelamin = $request->jenis_kelamin;
        $biodata->no_telepon = $request->no_telepon;
        $biodata->alamat = $request->alamat;
        $biodata->save();

        return redirect()->route('profile.index')->with('success', 'Biodata berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
