<?php

namespace App\Http\Controllers;

use App\Models\KotakSaran;
use Illuminate\Http\Request;

class DashboardKotakSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kotak Saran';
        $sarans = KotakSaran::latest()->paginate(10)->withQueryString();
        return view('backend.kotak-saran.index', compact('title', 'sarans'));
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
        $request->validate([
            'satgas_bekerja_dengan_baik' => 'required|string',
            'satgas_mengedukasi_dan_tanggap_laporan' => 'required|string',
            'harapan_dan_saran' => 'required|string',
        ]);

        $item = new KotakSaran();
        $item->user_id = auth()->user()->id;
        $item->satgas_bekerja_dengan_baik = $request->satgas_bekerja_dengan_baik;
        $item->satgas_mengedukasi_dan_tanggap_laporan = $request->satgas_mengedukasi_dan_tanggap_laporan;
        $item->harapan_dan_saran = $request->harapan_dan_saran;
        $item->save();

        return back()->with('success', 'Berhasil memberikan saran!');
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
        if ($request->has('respon_petugas')) {
            $request->validate([
                'respon_petugas' => 'required|string',

            ]);

            $item = KotakSaran::findOrFail($id);
            $item->respon_petugas = $request->respon_petugas;
            $item->update();

            return back()->with('success', 'Berhasil Memberikan respon!');
        }

        $request->validate([
            'satgas_bekerja_dengan_baik' => 'required|string',
            'satgas_mengedukasi_dan_tanggap_laporan' => 'required|string',
            'harapan_dan_saran' => 'required|string',
        ]);

        $item = KotakSaran::findOrFail($id);
        $item->user_id = auth()->user()->id;
        $item->satgas_bekerja_dengan_baik = $request->satgas_bekerja_dengan_baik;
        $item->satgas_mengedukasi_dan_tanggap_laporan = $request->satgas_mengedukasi_dan_tanggap_laporan;
        $item->harapan_dan_saran = $request->harapan_dan_saran;
        $item->update();

        return back()->with('success', 'Berhasil mengubah saran!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = KotakSaran::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Berhasil menghapus saran!');
    }
}
