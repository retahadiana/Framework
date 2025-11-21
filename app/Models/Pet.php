<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
     use HasFactory;
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan'];
    public $timestamps = false;

    /**
     * Cast attributes to appropriate types.
     * Ensure `tanggal_lahir` is a Carbon date instance so views can call ->format().
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet', 'idpet');
    }
}
