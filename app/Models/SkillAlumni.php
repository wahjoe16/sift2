<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillAlumni extends Model
{
    use HasFactory;
    protected $table ='skill_alumni';
    protected $guarded = [];

    public function user_skill_alumni()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
