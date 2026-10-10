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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->uuid('id_prestasi')->primary();
            $table->string('nama_prestasi', 100);
            $table->string('slug')->unique()->nullable();
            $table->string('tingkat', 50);
            $table->string('juara', 50);
            $table->year('tahun');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
