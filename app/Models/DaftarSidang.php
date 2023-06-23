<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarSidang extends Model
{
    use HasFactory;
    protected $table = 'daftar_sidang';
    protected $fillable = [
        'status_1', 'keterangan_1',
        'status_2', 'keterangan_2',
        'status_3', 'keterangan_3',
        'status_4', 'keterangan_4',
        'status_5', 'keterangan_5',
        'status_6', 'keterangan_6',
        'status_7', 'keterangan_7',
        'status_8', 'keterangan_8',
        'status_9', 'keterangan_9',
        'status_10', 'keterangan_10',
        'status_11', 'keterangan_11',
        'status_12', 'keterangan_12',
        'status_13', 'keterangan_13',
        'status_14', 'keterangan_14',
        'status_15', 'keterangan_15',
        'status_16', 'keterangan_16',
        'status_17', 'keterangan_17',
        'status_18', 'keterangan_18',
        'status_19', 'keterangan_19',
        'status_20', 'keterangan_20',
        'status', 'keterangan'
    ];

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
