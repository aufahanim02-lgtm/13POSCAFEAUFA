<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelKeranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'pelangganid',
        'produkid',
        'qty',
        'harga',
        'subtotal'
    ];

    public function produk()
    {
        return $this->belongsTo(ModelProduk::class, 'produkid');
    }

    public function pelanggan()
    {
        return $this->belongsTo(ModelPelanggan::class, 'pelangganid');
    }
}