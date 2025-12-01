<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class KategoriKlinis extends Model
{
    use SoftDeletes;
    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $timestamps = false;

    protected $fillable = ['nama_kategori_klinis', 'deleted_by'];

    public function kodeTindakanTerapi()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori_klinis');
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
