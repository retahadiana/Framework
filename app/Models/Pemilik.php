<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        //'nama_pemilik', // removed: name stored on related `user` table
        'no_wa',
        'alamat',
        'iduser',
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
}
