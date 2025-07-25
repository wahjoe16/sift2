<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'nama',
        'password',
        'program_studi',
        'level',
        'tipe_dosen',
        'class_pendidikan',
        'class_jabfung',
        'kelompok_keahlian',
        'email',
        'telepon',
        'status_aktif',
        'tahun_lulus',
        'foto',
        'tempat_lahir',
        'tanggal_lahir'
    ];

    protected $guard = 'alumni';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFotoPathAttribute()
    {
        if ($this->foto != '') {
            return url('/user/foto/' . $this->foto);
        } else {
            return 'http://placehold.it/850x618';
        }
    }

    public function daftar_seminar_dosen1()
    {
        return $this->hasMany(DaftarSeminar::class, 'id', 'dosen1_id');
    }

    public function daftar_seminar_dosen2()
    {
        return $this->hasMany(DaftarSeminar::class, 'id', 'dosen2_id');
    }

    public function daftar_sidang_dosen1()
    {
        return $this->hasMany(DaftarSidang::class, 'id', 'dosen1_id');
    }

    public function daftar_sidang_dosen2()
    {
        return $this->hasMany(DaftarSidang::class, 'id', 'dosen2_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(User::class);
    }

    public function archives()
    {
        return $this->belongsToMany(Archive::class, 'my_archives');
    }

    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'id', 'user_id');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            // menghapus relasi ke archive
            $model->archives()->detach();
        });
    }

    public function posts()
    {
        return $this->hasMany(PostAlumni::class);
    }

    public function comments()
    {
        return $this->hasMany(CommentPost::class);
    }
}
