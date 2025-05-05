<?php

namespace App\Http\Controllers;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function getFakultas()
    {
        return response()->json(Fakultas::all());
    }
}
