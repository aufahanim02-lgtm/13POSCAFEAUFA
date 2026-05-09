<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPenjualan extends Model
{
    protected $table = 'penjualan';

    protected $fillable = [
        'kodeinvoice',
        'userid',
        'shiftid',
        'mejaid',
        'promoid',
        'pajakid',
        'subtotal',
        'diskon',
        'pajak',
        'total',
        'status',
        'tanggalpenjualan'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // USER / KASIR
    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'userid', 'id');
    }

    // SHIFT
    public function shift()
    {
        return $this->belongsTo(ModelShift::class, 'shiftid', 'id');
    }

    // MEJA
    public function meja()
    {
        return $this->belongsTo(ModelMeja::class, 'mejaid', 'id');
    }

    // PROMO
    public function promo()
    {
        return $this->belongsTo(ModelPromo::class, 'promoid', 'id');
    }

    // PAJAK
    public function pajak()
    {
        return $this->belongsTo(ModelPajak::class, 'pajakid', 'id');
    }

    // DETAIL PENJUALAN
    public function detailpenjualan()
    {
        return $this->hasMany(ModelDetailPenjualan::class, 'penjualanid', 'id');
    }

    // PEMBAYARAN
    public function pembayaran()
    {
        return $this->hasOne(ModelPembayaran::class, 'penjualanid', 'id');
    }
}