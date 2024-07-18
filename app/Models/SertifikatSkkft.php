<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatSkkft extends Model
{
    use HasFactory;
    protected $table ='sertifikat_skkft';
    protected $guarded = [];

    public function user_skkft()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
