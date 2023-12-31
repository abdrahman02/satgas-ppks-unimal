<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::latest()->paginate(8);
        $lainnya = Berita::all();
        // Pastikan jumlah item yang diambil tidak melebihi jumlah item yang tersedia
        $jumlahItemDibutuhkan = 5;
        $jumlahItemTersedia = count($lainnya);

        if ($jumlahItemTersedia >= $jumlahItemDibutuhkan) {
            $otherNews = $lainnya->random($jumlahItemDibutuhkan);
        } else {
            $otherNews = $lainnya;
        }
        $title = 'Berita';
        return view('frontend.news.index', compact('beritas', 'otherNews', 'title'));
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
        $lainnya = Berita::where('id', '!=', $id)->get();

        // Pastikan ada cukup banyak berita lainnya sebelum mencoba mengambil acak
        $otherNewsCount = $lainnya->count();

        // Jika terdapat cukup banyak berita lainnya, ambil 5 berita acak, jika tidak, ambil semuanya
        $otherNews = $otherNewsCount >= 5 ? $lainnya->random(5) : $lainnya;
        $berita = Berita::findOrFail($id);
        $title = 'Detail Berita';
        return view('frontend.news.show', compact('otherNews', 'berita', 'title'));
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
