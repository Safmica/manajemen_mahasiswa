<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 8)->unique();
            $table->string('nama');
            $table->foreignId('prodi_id')->constrained('prodis')->onDelete('cascade');
            $table->text('alamat')->nullable();
            $table->year('angkatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
