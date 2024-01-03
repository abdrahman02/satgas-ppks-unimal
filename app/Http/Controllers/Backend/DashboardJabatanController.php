<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class DashboardJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Jabatan';
        $jabatan = Jabatan::latest()->paginate(15)->withQueryString();
        return view('backend.jabatan.index', compact('title', 'jabatan'));
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
            'nama_jabatan' => 'required|string|unique:jabatans,nama_jabatan',
            'level' => 'required|string'
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'level' => $request->level
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
            'nama_jabatan' => 'required|string|unique:jabatans,nama_jabatan,' . $id,
            'level' => 'required|string'
        ]);

        $item = Jabatan::find($id);

        $item->update([
            'nama_jabatan' => $request->nama_jabatan,
            'level' => $request->level
        ]);

        return redirect()->back()->with('success', 'Sukses, 1 Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Jabatan::findorFail($id);
        $item->delete();

        return back()->with('success', 'Sukses, 1 Data berhasil dihapus!');
    }
}
