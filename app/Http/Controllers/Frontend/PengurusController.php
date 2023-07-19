<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Jabatan;
use App\Models\Periode;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Struktur Organisasi';
        $posisiKetua = Jabatan::where('nama_jabatan', 'Ketua')->value('id');
        $posisiSekretaris = Jabatan::where('nama_jabatan', 'Sekretaris')->value('id');

        // Jika tidak ada periode yang dipilih, ambil periode sekarang
        if (!$request->has('periode')) {
            $periode = Periode::orderBy('created_at', 'desc')->first();
        } else {
            // Jika ada periode yang dipilih, ambil periode sesuai dengan nilai yang dikirim
            $periodeId = $request->input('periode');
            $periode = Periode::find($periodeId);
        }

        // Mengambil pengurus berdasarkan periode dan jabatan
        $ketua = Pengurus::where('periode_id', $periode->id)
            ->where('jabatan_id', $posisiKetua)
            ->first();

        $sekretaris = Pengurus::where('periode_id', $periode->id)
            ->where('jabatan_id', $posisiSekretaris)
            ->first();

        $anggota = Pengurus::where('periode_id', $periode->id)
            ->where('jabatan_id', '<>', $posisiKetua)
            ->where('jabatan_id', '<>', $posisiSekretaris)
            ->get();

        $periodes = Periode::all();

        return view('frontend.profile.struktur-organisasi', compact('title', 'periode', 'ketua', 'sekretaris', 'anggota', 'periodes'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
