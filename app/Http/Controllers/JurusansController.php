<?php

namespace App\Http\Controllers;
use App\Models\Jurusans;
use Illuminate\Http\Request;

class JurusansController extends Controller
{
    public function getJurusan(Request $request)
    {
        $jurusan = Jurusans::where('fakultas_id', $request->fakultas_id)->get();
        return response()->json($jurusan);
    }
}
