<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'prestasis';
    protected $primaryKey = 'id_prestasi';

    public $incrementuing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_prestasi', 'slug', 'tingkat', 'juara', 'tahun', 'deskripsi', 'foto'
    ];
}