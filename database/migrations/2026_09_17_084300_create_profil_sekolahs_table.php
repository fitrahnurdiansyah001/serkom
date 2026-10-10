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
        Schema::create('profil_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('foto')->nullable();
            $table->string('nama_sekolah');
            $table->string('kepala_sekolah');
            $table->string('npsn');
            $table->year('tahun_berdiri')->nullable();
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->text('visi');
            $table->text('misi');
            $table->text('sejarah')->nullable();
            $table->text('fasilitas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_sekolahs');
    }
};
