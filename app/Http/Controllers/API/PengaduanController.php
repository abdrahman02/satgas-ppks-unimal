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
        try {
            $user = Auth::user();
            if (!$user || empty($user->biodata)) {
                return response()->json(['message' => 'Silakan isi biodata terlebih dahulu'], 403);
            }
            $dataOnProcess = Pengaduan::where('user_id', $user->id)->where('progres', 'Sedang Proses')->get();
            return response()->json([
                'message' => 'Success Get All Data On Process',
                'Data' => $dataOnProcess,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Failed Get All Data On Process", "error" => $th], 500);
        }
    }

    public function getDataSelesai()
    {
        try {
            $user = Auth::user();
            $data = Pengaduan::where('user_id', $user->id);
            $dataSelesai = $data->where('progres', 'Selesai')->get();
            return response()->json([
                'message' => 'Success Get All Data On Process',
                'Data' => $dataSelesai
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Failed Get All Data Finished", "error" => $th], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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
            return response()->json(['message' => 'Sukses menambahkan laporan!'], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Gagal menambahkan laporan", "error" => $th], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $item = Pengaduan::find($id);

            if (!$item) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

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

            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->storeAs('public/pengaduan/', $filename);
                $item->bukti = $filename;
            }

            $item->save();

            return response()->json(['message' => 'Sukses memperbarui laporan!'], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Gagal memperbarui laporan", "error" => $th], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $item = Pengaduan::findOrFail($id);
            return response()->json(['message' => 'Berhasil mengambil data berdasarkan id', 'data' => $item], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal mengambil data berdasarkan id', 'error' => $th], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
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
