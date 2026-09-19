<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit agar sesuai dengan database (berita)
    protected $table = 'berita';
    
    // Menentukan primary key sesuai ERD
    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul', 'isi', 'tanggal', 'gambar', 'status', 'id_user'
    ];

    // Relasi ke User (Penulis Berita)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}