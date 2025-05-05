<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodis')->insert([
            ['id' => 1, 'jurusan_id' => 1, 'nama' => 'Teknik Informatika'],
            ['id' => 2, 'jurusan_id' => 2, 'nama' => 'Sistem Informasi'],
            ['id' => 3, 'jurusan_id' => 3, 'nama' => 'Teknik Tenaga Listrik'],
            ['id' => 4, 'jurusan_id' => 4, 'nama' => 'Rekayasa Struktur'],
            ['id' => 5, 'jurusan_id' => 5, 'nama' => 'Manajemen Keuangan'],
            ['id' => 6, 'jurusan_id' => 6, 'nama' => 'Akuntansi Publik'],
        ]);
    }
}
