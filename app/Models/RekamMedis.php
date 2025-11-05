<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TemuDokter;
use App\Models\RoleUser;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\DetailRekamMedis;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['created_at', 'idpet', 'idpemilik', 'anamnesa', 'temuan_klinis', 'diagnosa', 'idreservasi_dokter', 'dokter_pemeriksa'];
    // public $timestamps = false;
    /**
     * Casts to ensure created_at is treated as a DateTime instance in views.
     */

    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    

    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    public function pet()
{
    return $this->hasOneThrough(
        Pet::class, 
        TemuDokter::class, 
        'idreservasi_dokter', // foreign key di TemuDokter
        'idpet',              // foreign key di Pet
        'idreservasi_dokter', // local key di RekamMedis
        'idpet'               // local key di TemuDokter
    );
}
    public function pemilik()
{
    return $this->hasOneThrough(
        Pemilik::class,
        TemuDokter::class,
        'idreservasi_dokter',
        'idpemilik',
        'idreservasi_dokter',
        'idpemilik'
    );
}


    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

}

