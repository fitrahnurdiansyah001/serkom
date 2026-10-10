<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'programs';
    protected $primaryKey = 'id_program';

    // Konfigurasi wajib untuk UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_program', 'slug', 'deskripsi'
    ];
}