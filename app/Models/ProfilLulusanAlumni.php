<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilLulusanAlumni extends Model
{
    use HasFactory;
    protected $table = 'profil_lulusan_alumni';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
