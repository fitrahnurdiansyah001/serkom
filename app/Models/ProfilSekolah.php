<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah', 'kepala_sekolah', 'npsn', 'tahun_berdiri',
        'alamat', 'telepon', 'email', 'visi', 'misi', 'sejarah', 'fasilitas'
    ];
}