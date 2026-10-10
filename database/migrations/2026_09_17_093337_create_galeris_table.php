<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galeris', function (Blueprint $table) {
            $table->uuid('id_galeri')->primary();
            $table->text('judul');
            $table->string('slug')->unique()->nullable();
            $table->text('keterangan')->nullable();
            $table->string('file', 225)->nullable();
            $table->enum('kategori', ['Foto', 'Video']);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};
