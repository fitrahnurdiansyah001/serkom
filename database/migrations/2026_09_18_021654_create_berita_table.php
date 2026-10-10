<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->uuid('id_berita')->primary();
            $table->string('judul', 255);
            $table->string('slug')->unique()->nullable();
            $table->string('kategori', 30)->default('Berita');
            $table->text('isi');
            $table->date('tanggal');
            $table->string('gambar', 100)->nullable();
            $table->enum('status', ['Publish', 'Draft']);
            $table->string('penulis')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};