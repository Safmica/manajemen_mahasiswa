<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prodis');
    }
};
