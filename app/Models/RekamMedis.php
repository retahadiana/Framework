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
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class RekamMedis extends Model
{
    use SoftDeletes;
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $incrementing = true;
    protected $keyType = 'int';
    // Keep fillable in sync with actual database columns for `rekam_medis`.
    // The table doesn't include `idpet`/`idpemilik` in this schema, so omit them.
    protected $fillable = ['created_at', 'anamnesa', 'temuan_klinis', 'diagnosa', 'idreservasi_dokter', 'dokter_pemeriksa', 'deleted_by'];
    // public $timestamps = false;

    // This table does not have `updated_at` column; disable Eloquent timestamps
    public $timestamps = false;

    /**
     * Ensure created_at is treated as a DateTime/Carbon instance in views
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];
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

