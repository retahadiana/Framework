<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class KodeTindakanTerapi extends Model
{
    use SoftDeletes;
    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'deskripsi_tindakan_terapi',
        'idkategori',
        'idkategori_klinis',
        'deleted_by',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }

    public function kategoriKlinis()
    {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idkode_tindakan_terapi');
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
