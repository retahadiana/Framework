<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Pemilik;
use App\Models\RoleUser;
use App\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')->withPivot('status');
    }
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];
    public $timestamps = false;


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     // Relasi ke Pemilik
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser');
    }

    // Relasi ke RoleUser (pivot)
    // Relasi ke RoleUser (pivot)
    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'iduser');
    }   

    // Relasi ke Role (many to many, jika diperlukan)

    // Relasi ke RekamMedis (jika diperlukan)
    public function rekamMedis()
    {
        return $this->hasMany(\App\Models\RekamMedis::class, 'dokter_pemeriksa');
    }
}
