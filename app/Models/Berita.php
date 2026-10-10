<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'judul', 'slug', 'isi', 'tanggal', 'gambar', 'status', 'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}