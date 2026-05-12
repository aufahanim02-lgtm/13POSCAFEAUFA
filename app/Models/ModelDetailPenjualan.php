<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDetailPenjualan extends Model
{
    protected $table = 'detailpenjualan';

    protected $fillable = [
        'penjualanid',
        'produkid',
        'qty',
        'harga',
        'subtotal',
        'statusitem'
    ];

    public function penjualan()
    {
        return $this->belongsTo(ModelPenjualan::class, 'penjualanid');
    }

    public function produk()
    {
        return $this->belongsTo(ModelProduk::class, 'produkid');
    }
}