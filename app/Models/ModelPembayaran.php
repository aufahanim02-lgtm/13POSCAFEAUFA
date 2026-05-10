<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'penjualanid',
        'metodepembayaranid',
        'jumlahbayar',
        'kembalian',
        'tanggalbayar',
        'buktibayar',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // PENJUALAN
    public function penjualan()
    {
        return $this->belongsTo(
            ModelPenjualan::class,
            'penjualanid',
            'id'
        );
    }

    // METODE PEMBAYARAN
    public function metode()
    {
        return $this->belongsTo(
            ModelMetodePembayaran::class,
            'metodepembayaranid',
            'id'
        );
    }
}