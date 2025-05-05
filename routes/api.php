<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JurusansController;
use App\Http\Controllers\ProdisController;

Route::get('/fakultas', [FakultasController::class, 'getFakultas']);
Route::get('/jurusan', [JurusansController::class, 'getJurusan']);
Route::get('/prodi', [ProdisController::class, 'getProdi']);
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);
