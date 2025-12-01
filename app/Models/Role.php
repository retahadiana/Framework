<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use SoftDeletes;
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
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                if (method_exists($model, 'saveQuietly')) {
                    $model->saveQuietly();
                } else {
                    $model->save();
                }
            }
        });
    }
    
}
