<?php

namespace App\Http\Controllers\API;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $beritas = Berita::all();
        return response()->json(['data' => $beritas, 'user' => $user]);
    }

    public function show(String $id)
    {
        $item = Berita::findOrFail($id);
        return response()->json(['data' => $item]);
    }
}
