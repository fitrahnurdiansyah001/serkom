<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'kelas_id',
        'slug',
        'jenis_kelamin',
        'tahun_masuk'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
