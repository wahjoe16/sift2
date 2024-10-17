<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsAlumni extends Model
{
    use HasFactory;
    protected $table = 'jobs_alumni';
    protected $guarded = [];

    public function user_jobs_alumni()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class);
    }
}
