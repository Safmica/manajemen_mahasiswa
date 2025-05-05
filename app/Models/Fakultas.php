<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';
    public $timestamps = false;

    protected $fillable = ['nama'];

    public function jurusans()
    {
        return $this->hasMany(Jurusan::class);
    }
}
