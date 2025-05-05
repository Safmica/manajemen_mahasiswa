<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodis extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jurusan_id'];
    public $timestamps = false;

    public function jurusan()
    {
        return $this->belongsTo(Jurusans::class);
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
