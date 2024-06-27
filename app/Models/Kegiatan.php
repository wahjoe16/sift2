<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $guarded = [];

    public function categories_skkft()
    {
        return $this->belongsTo(CategorySkkft::class, 'category_id', 'id');
    }

    public function subcategories_skkft()
    {
        return $this->belongsTo(SubcategorySkkft::class,'subcategory_id', 'id');
    }

    public function tingkat_skkft()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat_id', 'id');
    }

    public function prestasi_skkft()
    {
        return $this->belongsTo(PrestasiSkkft::class, 'prestasi_id', 'id');
    }

    public function jabatan_skkft()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }
}
