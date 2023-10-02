<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $table = 'archives';
    protected $fillable = ['name', 'file', 'section_id', 'category_archive_id', 'subcategory_archive_id', 'tahun_ajaran_id', 'semester_id'];

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function category_archive()
    {
        return $this->belongsTo(CategoryArchive::class, 'category_archive_id', 'id');
    }

    public function subcategory_archive()
    {
        return $this->belongsTo(SubcategoryArchive::class, 'subcategory_archive_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'my_archives');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            // menghapus relasi ke user
            $model->users()->detach();
        });
    }
}
