<?php

namespace App\Http\Controllers\Backend;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardUserPengaduan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pengaduan';
        $user = Auth::user();
        if ($user->role == 'pengguna') {
            // $data = Pengaduan::where('user_id', $user->id)->latest()->paginate(10)->withQueryString();
            $data = Pengaduan::where('user_id', $user->id);
            $dataOnProcess = $data->where('progres', 'Sedang Proses')->latest()->paginate(10)->withQueryString();
            $dataSelesai = $data->where('progres', 'Selesai')->latest()->paginate(10)->withQueryString();
            return view('backend.pengaduan.index', compact('title', 'dataOnProcess', 'dataSelesai', 'user'));
        } elseif ($user->role == 'petugas') {
            // $data = Pengaduan::latest()->paginate(10)->withQueryString();
            $dataOnProcess = Pengaduan::where('progres', 'Sedang Proses')->latest()->paginate(10)->withQueryString();
            $dataSelesai = Pengaduan::where('progres', 'Selesai')->latest()->paginate(10)->withQueryString();
            return view('backend.pengaduan.index', compact('title', 'dataOnProcess', 'dataSelesai', 'user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Lapor!';
        return view('backend.pengaduan.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'prodi' => 'nullable',
            'fakultas' => 'nullable',
            'memiliki_disabilitas' => 'required|string|in:Ya,Tidak',
            'nama_pelaku' => 'nullable',
            'status_pelaku' => 'required|string',
            'nim_nip_nik_pelaku' => 'nullable',
            'asal_instansi_pelaku' => 'nullable',
            'kontak_pelaku' => 'nullable',
            'kronologi_kejadian' => 'required|string',
            'waktu_kejadian' => 'required|string',
            'bukti' => 'required|mimes:pdf,zip,jpeg,png,jpg,gif,svg|'
        ]);

        $item = new Pengaduan();
        $item->prodi = $request->prodi;
        $item->fakultas = $request->fakultas;
        $item->memiliki_disabilitas = $request->memiliki_disabilitas;
        $item->nama_pelaku = $request->nama_pelaku;
        $item->status_pelaku = $request->status_pelaku;
        $item->nim_nip_nik_pelaku = $request->nim_nip_nik_pelaku;
        $item->asal_instansi_pelaku = $request->asal_instansi_pelaku;
        $item->kontak_pelaku = $request->kontak_pelaku;
        $item->kronologi_kejadian = $request->kronologi_kejadian;
        $item->waktu_kejadian = $request->waktu_kejadian;
        $item->user_id = auth()->user()->id;

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('public/pengaduan/', $filename);
            $item->bukti = $filename;
        }

        $item->save();

        return redirect()->route('laporan.index')->with('success', 'Sukses, 1 Data berhasil ditambahkan!');
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
        if ($request->has('ubhKeSelesai')) {
            $item = Pengaduan::findOrFail($id);
            $item->progres = $request->ubhKeSelesai;
            $item->save();
            return back()->with('success', 'Status berhasil diubah!');
        } elseif ($request->has('ubhKeSedangProses')) {
            $item = Pengaduan::findOrFail($id);
            $item->progres = $request->ubhKeSedangProses;
            $item->save();
            return back()->with('success', 'Status berhasil diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Pengaduan::findorFail($id);
        if ($item->image) {
            Storage::delete('public/pengaduan/' . $item->image);
        }
        $item->delete();

        return redirect()->route('laporan.index')->with('success', 'Sukses, 1 Data berhasil dihapus!');
    }
}
