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

    public function profesi_alumni()
    {
        return $this->belongsTo(ProfesiAlumni::class, 'profesi_id', 'id');
    }

    public function jabatan_profesi_alumni()
    {
        return $this->belongsTo(JabatanProfesi::class, 'jabatan_id', 'id');
    }
}
