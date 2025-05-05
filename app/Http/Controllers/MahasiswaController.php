<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('prodi.jurusan.fakultas')->get();
        return response()->json($mahasiswa);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|digits:8|unique:mahasiswas,nim',
            'nama' => 'required|min:3',
            'prodi_id' => 'required|exists:prodis,id',
            'alamat' => 'nullable|string',
            'angkatan' => 'required|digits:4'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json($mahasiswa, 201);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nim' => 'required|digits:8|unique:mahasiswas,nim,' . $id,
            'nama' => 'required|min:3',
            'prodi_id' => 'required|exists:prodis,id',
            'alamat' => 'nullable|string',
            'angkatan' => 'required|digits:4'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mahasiswa->update($request->all());

        return response()->json($mahasiswa);
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}

