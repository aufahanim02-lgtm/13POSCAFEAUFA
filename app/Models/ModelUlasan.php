<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelUlasan extends Model
{
    protected $table = 'ulasan';

    protected $fillable = [
        'penjualanid',
        'pelangganid',
        'produkid',
        'rating',
        'komentar',
        'tanggal'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(ModelPelanggan::class, 'pelangganid');
    }

    public function produk()
    {
        return $this->belongsTo(ModelProduk::class, 'produkid');
    }

    public function penjualan()
    {
        return $this->belongsTo(ModelPenjualan::class, 'penjualanid');
    }
}