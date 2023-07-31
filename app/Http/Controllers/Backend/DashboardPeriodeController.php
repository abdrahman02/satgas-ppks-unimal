<?php

namespace App\Http\Controllers\Backend;

use App\Models\Periode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardPeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Periode';
        $periode = Periode::latest()->paginate(15)->withQueryString();
        return view('backend.periode.index', compact('title', 'periode'));
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
            'masa_periode' => 'required|string|unique:periodes,masa_periode'
        ]);

        Periode::create([
            'masa_periode' => $request->masa_periode,
        ]);

        return redirect()->back()->with('success', 'Sukses, 1 Data berhasil ditambahkan!');
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
            'masa_periode' => 'required|string|unique:periodes,masa_periode,' . $id
        ]);

        $item = Periode::find($id);

        $item->update([
            'masa_periode' => $request->masa_periode,
        ]);

        return redirect()->back()->with('success', 'Sukses, 1 Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Periode::findorFail($id);
        $item->delete();

        return back()->with('success', 'Sukses, 1 Data berhasil dihapus!');
    }
}
