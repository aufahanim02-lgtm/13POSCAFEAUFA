<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelWishlist extends Model
{
    protected $table = 'wishlist';

    protected $fillable = [
        'pelangganid',
        'produkid'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function pelanggan()
    {
        return $this->belongsTo(ModelPelanggan::class, 'pelangganid');
    }

    public function produk()
    {
        return $this->belongsTo(ModelProduk::class, 'produkid');
    }
}