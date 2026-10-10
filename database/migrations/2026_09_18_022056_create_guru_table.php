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
        Schema::create('guru', function (Blueprint $table) {
            $table->uuid('id_guru')->primary();
            $table->string('nama_guru');
            $table->string('slug')->unique()->nullable();
            $table->string('jabatan')->nullable();
            $table->string('nip')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
