<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategorySkkft extends Model
{
    use HasFactory;
    protected $table='subcategory_skkft';
    protected $guarded = [];

    public function categories_skkft()
    {
        return $this->belongsTo(CategorySkkft::class, 'category_id', 'id');
    }
}
