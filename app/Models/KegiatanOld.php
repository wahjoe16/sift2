<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanOld extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_old';
    protected $guarded = [];

    public function attribute_mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }
}
