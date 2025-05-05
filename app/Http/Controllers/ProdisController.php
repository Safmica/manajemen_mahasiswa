<?php

namespace App\Http\Controllers;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdisController extends Controller
{
    public function getProdi(Request $request)
    {
        $prodi = Prodi::where('jurusan_id', $request->jurusan_id)->get();
        return response()->json($prodi);
    }
}
