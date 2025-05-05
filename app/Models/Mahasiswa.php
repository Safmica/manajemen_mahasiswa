<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['nim', 'nama', 'prodi_id', 'alamat', 'angkatan'];

    public function prodi()
    {
        return $this->belongsTo(Prodis::class);
    }
}
