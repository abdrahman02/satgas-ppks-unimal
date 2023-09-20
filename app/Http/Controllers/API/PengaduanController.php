<?php

namespace App\Http\Controllers\API;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function getDataOnProcess()
    {
        $user = Auth::user();
        $data = Pengaduan::where('user_id', $user->id);
        $dataOnProcess = $data->where('progres', 'Sedang Proses')->get();

        return response()->json([
            'user' => $user,
            'Data on process' => $dataOnProcess
        ]);
    }

    public function getDataSelesai()
    {
        $user = Auth::user();
        $data = Pengaduan::where('user_id', $user->id);
        $dataSelesai = $data->where('progres', 'Selesai')->get();

        return response()->json([
            'user' => $user,
            'Data Selesai' => $dataSelesai
        ]);
    }

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

        return response()->json([
            'alert' => 'Sukses menambahkan 1 laporan!',
            'data' => $item
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Pengaduan::findOrFail($id);

        return response()->json([
            'data' => $item
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Pengaduan::findorFail($id);
        if ($item->bukti) {
            Storage::delete('public/pengaduan/' . $item->bukti);
        }
        $item->delete();

        return response()->json([
            'alert' => 'Sukses menghapus 1 laporan!',
            'data' => $item
        ]);
    }
}
