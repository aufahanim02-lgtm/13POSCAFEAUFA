<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPesananPelanggan extends Model
{
    protected $table = 'pesananpelanggan';

    protected $fillable = [
        'pelangganid',
        'penjualanid',
        'statuspesanan',
        'statuspembayaran',
        'tanggalpesan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(ModelPelanggan::class, 'pelangganid');
    }

    public function penjualan()
    {
        return $this->belongsTo(ModelPenjualan::class, 'penjualanid');
    }
}