<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    use HasFactory;
    protected $table ='skpi';
    protected $guarded = [];

    public function user_skpi()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
