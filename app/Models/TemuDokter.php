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
        'idrole_user',
        'no_urut',
        'waktu_daftar',
        'status',
        'keterangan',
    ];

    /**
     * Cast date/time columns to Carbon instances so views can call ->format()
     */
    protected $casts = [
        'waktu_daftar' => 'datetime',
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

    /**
     * Convenience accessor: resolve pemilik via the related pet.
     * The `temu_dokter` table does not contain `idpemilik`; use pet->pemilik instead.
     */
    public function getPemilikAttribute()
    {
        return $this->pet ? $this->pet->pemilik : null;
    }

    /**
     * Backwards-compatible accessor: some legacy code expects `tanggal_reservasi`.
     * If that column is missing, return `waktu_daftar` as a fallback.
     */
    public function getTanggalReservasiAttribute()
    {
        if (array_key_exists('tanggal_reservasi', $this->attributes) && $this->attributes['tanggal_reservasi']) {
            return $this->asDateTime($this->attributes['tanggal_reservasi']);
        }

        if (array_key_exists('waktu_daftar', $this->attributes) && $this->attributes['waktu_daftar']) {
            return $this->asDateTime($this->attributes['waktu_daftar']);
        }

        return null;
    }

    /**
     * Relation to the role_user row that represents the assigned doctor for this reservation.
     */
    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }
}
