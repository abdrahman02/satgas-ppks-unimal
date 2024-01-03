<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tema;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardPertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pertanyaan ChatBot';
        $pertanyaans = Pertanyaan::latest()->paginate(15)->withQueryString();
        $temas = Tema::all();
        return view('backend.bot.pertanyaan', compact('title', 'temas', 'pertanyaans'));
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
            'tema_id' => 'required|max:255',
            'pertanyaan' => 'required|max:255',
            'jawaban' => 'required|max:255'
        ]);

        $item = new Pertanyaan();
        $item->tema_id = $request->tema_id;
        $item->pertanyaan = $request->pertanyaan;
        $item->jawaban = $request->jawaban;
        $item->save();

        return back()->with('success', 'Sukses, 1 data berhasil ditambahkan!');
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
            'tema_id' => 'required|max:255',
            'pertanyaan' => 'required|max:255',
            'jawaban' => 'required|max:255'
        ]);

        $item = Pertanyaan::findOrFail($id);
        $item->tema_id = $request->tema_id;
        $item->pertanyaan = $request->pertanyaan;
        $item->jawaban = $request->jawaban;
        $item->update();

        return back()->with('success', 'Sukses, 1 data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Pertanyaan::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Sukses, 1 data berhasil dihapus!');
    }
}
