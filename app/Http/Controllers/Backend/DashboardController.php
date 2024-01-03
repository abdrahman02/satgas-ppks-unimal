<?php

namespace App\Http\Controllers\Backend;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $title = 'Overview';

        $bulanTahunPertama = null;
        $bulanTahunTerbaru = null;
        $jumlah_berita = 0;
        $bulanTahunOnProcessPertama = null;
        $bulanTahunOnProcessTerbaru = null;
        $jumlah_OnProcess = 0;
        $bulanTahunSelesaiPertama = null;
        $bulanTahunSelesaiTerbaru = null;
        $jumlah_Selesai = 0;
        $bulanTahunPenggunaPertama = null;
        $bulanTahunPenggunaTerbaru = null;
        $jumlah_Pelanggan = 0;

        // BERITA
        // Mendapatkan data pertama
        $dataPertama = Berita::orderBy('created_at')->first();
        if ($dataPertama) {
            $bulanTahunPertama = date('F Y', strtotime($dataPertama->created_at));
        }
        // Mendapatkan data terbaru
        $dataTerbaru = Berita::orderBy('created_at', 'desc')->first();
        if ($dataTerbaru) {
            $bulanTahunTerbaru = date('F Y', strtotime($dataTerbaru->created_at));
        }
        // jumlah data
        $jumlah_berita = Berita::count();


        $dataOnProcessPertama = Pengaduan::where('progres', 'Sedang Proses')->orderBy('created_at')->first();
        $dataSelesaiPertama = Pengaduan::where('progres', 'Selesai')->orderBy('created_at')->first();
        // Data Sedang Proses
        // Mendapatkan data pertama
        if (isset($dataOnProcessPertama)) {
            $bulanTahunOnProcessPertama = date('F Y', strtotime($dataOnProcessPertama->created_at));
            // Mendapatkan data terbaru
            $dataOnProcessTerbaru = Pengaduan::where('progres', 'Sedang Proses')->orderBy('created_at', 'desc')->first();
            $bulanTahunOnProcessTerbaru = date('F Y', strtotime($dataOnProcessTerbaru->created_at));
            // Jumlah data
            $jumlah_OnProcess = Pengaduan::where('progres', 'Sedang Proses')->count();
        } elseif ($dataSelesaiPertama) {
            // Data Selesai
            // Mendapatkan data terbaru
            $bulanTahunSelesaiPertama = date('F Y', strtotime($dataSelesaiPertama->created_at));
            $dataSelesaiTerbaru = Pengaduan::where('progres', 'Selesai')->orderBy('created_at', 'desc')->first();
            $bulanTahunSelesaiTerbaru = date('F Y', strtotime($dataSelesaiTerbaru->created_at));
            // Jumlah data
            $jumlah_Selesai = Pengaduan::where('progres', 'Selesai')->count();
        }


        // Pengguna
        $dataPenggunaPertama = User::where('role', 'pengguna')->orderBy('created_at')->first();
        $dataPenggunaTerbaru = User::where('role', 'pengguna')->orderBy('created_at')->first();
        if ($dataPenggunaPertama) {
            $bulanTahunPenggunaPertama = date('F Y', strtotime($dataPenggunaPertama->created_at));
        } else if ($dataPenggunaTerbaru) {
            $bulanTahunPenggunaTerbaru = date('F Y', strtotime($dataPenggunaTerbaru->created_at));
        }
        // Jumlah data
        $jumlah_Pengguna = User::where('role', 'pengguna')->count();

        return view('backend.index', compact('title', 'user', 'bulanTahunPertama', 'bulanTahunTerbaru', 'jumlah_berita', 'bulanTahunOnProcessPertama', 'bulanTahunOnProcessTerbaru', 'jumlah_OnProcess', 'bulanTahunSelesaiPertama', 'bulanTahunSelesaiTerbaru', 'jumlah_Selesai', 'bulanTahunPenggunaPertama', 'bulanTahunPenggunaTerbaru', 'jumlah_Pengguna'));
    }
}
