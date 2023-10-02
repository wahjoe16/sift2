<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyArchive extends Model
{
    use HasFactory;
    protected $table = 'my_archives';
    protected $fillable = ['user_id', 'archive_id', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function archives()
    {
        return $this->hasOne(Archive::class);
    }
}
