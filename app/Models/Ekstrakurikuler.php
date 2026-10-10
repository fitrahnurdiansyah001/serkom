<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ekstrakurikulers';
    protected $primaryKey = 'id_ekskul';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_ekskul',
        'slug',
        'pembina',
        'jadwal',
        'deskripsi',
        'foto'
    ];
}