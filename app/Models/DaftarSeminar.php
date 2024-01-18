<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DaftarSeminar extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'daftar_seminar';
    protected $guarded = [];

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    public function dosen_1()
    {
        return $this->belongsTo(User::class, 'dosen1_id', 'id');
    }

    public function dosen_2()
    {
        return $this->belongsTo(User::class, 'dosen2_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'id');
    }
}
