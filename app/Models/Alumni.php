<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';
    protected $guarded = [];

    public function user_alumni()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
