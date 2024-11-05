<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanProfesi extends Model
{
    use HasFactory;
    protected $table = 'jabatan_profesi';
    protected $guarded = [];

    public function profesix()
    {
        return $this->belongsTo(ProfesiAlumni::class, 'profesi_id', 'id');
    }
}
