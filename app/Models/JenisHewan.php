<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class JenisHewan extends Model
{
    use SoftDeletes;
    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    public $timestamps = false;

    protected $fillable = ['nama_jenis_hewan', 'deleted_by'];

    public function rasHewan()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan');
    }
    /**
     * Record who deleted the model (deleted_by) on soft delete.
     */
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
