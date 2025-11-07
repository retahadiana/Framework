<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;

    protected $fillable = [
        'nama_role',
    ];

    // Relasi ke RoleUser
    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'idrole');
    }
    // Relasi ke User
    public function user()
    {
        return $this->hasMany(User::class, 'iduser');
    }
    
}
