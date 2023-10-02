<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryArchive extends Model
{
    use HasFactory;
    protected $table = 'subcategory_archives';
    protected $fillable = ['name', 'description', 'section_id', 'category_archive_id'];

    public function section_id()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function category_archive_id()
    {
        return $this->belongsTo(CategoryArchive::class, 'category_archive_id', 'id');
    }
}
