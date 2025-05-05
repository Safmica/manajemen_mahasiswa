<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusans extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'fakultas_id'];
    public $timestamps = false;

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function prodis()
    {
        return $this->hasMany(Prodis::class);
    }
}
