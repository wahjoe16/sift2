<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeahlianAlumni extends Model
{
    use HasFactory;
    protected $table = 'keahlian_alumni';
    protected $guarded = [];

    public function user_keahlian_alumni()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
