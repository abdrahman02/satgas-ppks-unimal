<?php

namespace App\Http\Controllers\Backend;

use App\Models\Jabatan;
use App\Models\Periode;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardPengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pengurus';
        $jabatan = Jabatan::all();
        $periode = Periode::all();
        $pengurus = Pengurus::latest()->paginate(15)->withQueryString();
        return view('backend.pengurus.index', compact('title', 'pengurus', 'jabatan', 'periode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Pengurus';
        $jabatan = Jabatan::all();
        $periode = Periode::all();
        return view('backend.pengurus.create', compact('title', 'jabatan', 'periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengurus' => 'required|string',
            'latar_belakang' => 'required|string',
            'jabatan_id' => 'required',
            'periode_id' => 'required',
        ]);

        $item = new Pengurus;

        $item->nama_pengurus = $request->nama_pengurus;
        $item->latar_belakang = $request->latar_belakang;
        $item->jabatan_id = $request->jabatan_id;
        $item->periode_id = $request->periode_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('public/struktur-organisasi', $filename);
            $item->image = $filename;
        }

        $item->save();

        return redirect()->route('pengurus.index')->with('success', 'Sukses, 1 Data berhasil ditambahkan!');
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
        $title = 'Ubah Pengurus';
        $jabatan = Jabatan::all();
        $periode = Periode::all();
        $pengurus = Pengurus::findOrFail($id);
        return view('backend.pengurus.edit', compact('title', 'pengurus', 'jabatan', 'periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pengurus' => 'required|string',
            'latar_belakang' => 'required|string',
            'jabatan_id' => 'required',
            'periode_id' => 'required',
        ]);

        $item = Pengurus::find($id);

        $item->nama_pengurus = $request->nama_pengurus;
        $item->latar_belakang = $request->latar_belakang;
        $item->jabatan_id = $request->jabatan_id;
        $item->periode_id = $request->periode_id;

        if ($request->hasFile('image')) {
            // menghapus gambar lama
            if ($request->oldImage) {
                Storage::delete('public/struktur-organisasi/' . $item->image);
            }
            // menyimpan gambar baru
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('public/struktur-organisasi/', $filename);
            $item->image = $filename;
        }

        $item->save();

        return redirect()->route('pengurus.index')->with('success', 'Sukses, 1 Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Pengurus::findOrFail($id);
        if ($item->image) {
            Storage::delete('public/struktur-organisasi/' . $item->image);
        }
        $item->delete();

        return back()->with('success', 'Sukses, 1 Data berhasil dihapus!');
    }
}
