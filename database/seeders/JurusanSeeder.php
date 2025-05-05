<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jurusans')->insert([
            ['id' => 1, 'fakultas_id' => 1, 'nama' => 'Informatika'],
            ['id' => 2, 'fakultas_id' => 1, 'nama' => 'Sistem Informasi'],
            ['id' => 3, 'fakultas_id' => 2, 'nama' => 'Teknik Elektro'],
            ['id' => 4, 'fakultas_id' => 2, 'nama' => 'Teknik Sipil'],
            ['id' => 5, 'fakultas_id' => 3, 'nama' => 'Manajemen'],
            ['id' => 6, 'fakultas_id' => 3, 'nama' => 'Akuntansi'],
        ]);
    }
}
