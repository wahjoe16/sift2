<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryArchive extends Model
{
    use HasFactory;
    protected $table = 'category_archives';
    protected $fillable = ['name', 'description', 'section_id'];

    public function section_id()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
