<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_guru',
        'slug',
        'jabatan',
        'nip',
        'mata_pelajaran',
        'foto'
    ];
}