<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    /**
     * Table and primary key used by this model.
     */
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * No automatic timestamps on this legacy-style table.
     */
    public $timestamps = false;

    /**
     * Safe assignable attributes — keep these minimal and generic so the model
     * can be used even if your actual schema differs slightly.
     */
    protected $fillable = [
        'idpet',
        'idpemilik',
        'tanggal_reservasi',
        'jam_mulai',
        'jam_selesai',
        'status',
        'keterangan',
    ];

    /**
     * A TemuDokter may have one or more RekamMedis records tied to the
     * reservation (rekam_medis.idreservasi_dokter -> temu_dokter.idreservasi_dokter).
     */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    /**
     * Relations to Pet and Pemilik for easy access from views / controllers.
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }
}
