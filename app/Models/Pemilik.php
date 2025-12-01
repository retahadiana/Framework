<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Pemilik extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        //'nama_pemilik', // removed: name stored on related `user` table
        'no_wa',
        'alamat',
        'iduser',
        'deleted_by',
    ];

    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /**
     * Accessor to provide `nama_pemilik` even if the actual name is stored
     * on the related `user` table (legacy schema compatibility).
     */
    public function getNamaPemilikAttribute()
    {
        // If the column exists and has a value, use it; otherwise fall back to related user.nama
        if (array_key_exists('nama_pemilik', $this->attributes) && $this->attributes['nama_pemilik']) {
            return $this->attributes['nama_pemilik'];
        }

        return optional($this->user)->nama;
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpemilik', 'idpemilik');
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
