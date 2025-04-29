<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentPost extends Model
{
    use HasFactory;
    protected $table = 'comment_post';
    protected $guarded = [];

    public function posts()
    {
        return $this->belongsTo(PostAlumni::class);
    }

    public function user_comment_post()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
