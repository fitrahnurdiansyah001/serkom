<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'tanggal',
        'status',
        'foto',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}