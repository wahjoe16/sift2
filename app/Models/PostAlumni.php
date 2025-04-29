<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAlumni extends Model
{
    use HasFactory;
    protected $table = 'post_alumni';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(CommentPost::class, 'post_id', 'id');
    }

    // public function getDateFormat()
    // {
    //     return $this->date->date_format('d-m-Y');
    // }


}
