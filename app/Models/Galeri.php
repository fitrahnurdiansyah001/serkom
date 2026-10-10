<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'galeris';
    protected $primaryKey = 'id_galeri';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'judul','slug', 'keterangan', 'file', 'kategori', 'tanggal'
    ];
}