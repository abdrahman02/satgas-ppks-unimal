<?php

namespace App\Http\Controllers\Backend;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Berita';
        $news = Berita::latest()->paginate(15)->withQueryString();

        return view('backend.news.index', compact('title', 'news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Berita';
        return view('backend.news.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_berita' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $item = new Berita();
        $item->judul_berita = $request->judul_berita;
        $item->body = $request->body;
        $item->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('public/berita', $filename);
            $item->image = $filename;
        }

        $item->save();

        return redirect()->route('news.index')->with('success', 'Sukses, 1 Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Lihat Berita';
        $news = Berita::findOrFail($id);
        return view('backend.news.show', compact('title', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Ubah Berita';
        $news = Berita::findOrFail($id);
        return view('backend.news.edit', compact('title', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul_berita' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $item = Berita::findOrFail($id);
        $item->judul_berita = $request->judul_berita;
        $item->body = $request->body;
        $item->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            // menghapus gambar lama
            if ($request->oldImage) {
                Storage::delete('public/berita/' . $item->image);
            }
            // menyimpan gambar baru
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('public/berita', $filename);
            $item->image = $filename;
        }

        $item->save();

        return redirect()->route('news.index')->with('success', 'Sukses, 1 Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Berita::findorFail($id);
        if ($item->image) {
            Storage::delete('public/berita/' . $item->image);
        }
        $item->delete();

        return redirect()->route('news.index')->with('success', 'Sukses, 1 Data berhasil dihapus!');
    }
}
