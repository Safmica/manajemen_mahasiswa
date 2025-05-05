<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fakultas')->insert([
            ['id' => 1, 'nama' => 'Fakultas Ilmu Komputer'],
            ['id' => 2, 'nama' => 'Fakultas Teknik'],
            ['id' => 3, 'nama' => 'Fakultas Ekonomi'],
        ]);
    }
}
