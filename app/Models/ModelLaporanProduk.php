<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLaporanProduk extends Model
{
    protected $table = 'laporanproduk';

    protected $fillable = [
        'userid',
        'produkid',
        'totalterjual',
        'totalpendapatan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'userid');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI PRODUK
    |--------------------------------------------------------------------------
    */

    public function produk()
    {
        return $this->belongsTo(ModelProduk::class, 'produkid');
    }
}