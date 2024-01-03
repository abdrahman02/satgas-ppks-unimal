<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardTemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Tema Percakapan Bot';
        $temas = Tema::latest()->paginate(15)->withQueryString();
        return view('backend.bot.tema', compact('title', 'temas'));
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
            'tema' => 'required|max:255'
        ]);

        $tema = new Tema();
        $tema->tema = $request->tema;
        $tema->save();

        return back()->with('success', 'Sukses, 1 tema berhasil ditambahkan!');
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
            'tema' => 'required|max:255'
        ]);

        $tema = Tema::findOrFail($id);
        $tema->tema = $request->tema;
        $tema->update();

        return back()->with('success', 'Sukses, 1 tema berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tema = Tema::findOrFail($id);
        $tema->delete();

        return back()->with('success', 'Sukses, 1 Tema berhasil dihapus!');
    }
}
