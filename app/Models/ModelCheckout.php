<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCheckout extends Model
{
    protected $table = 'checkout';

    protected $fillable = [
        'pelangganid',
        'kodecheckout',
        'subtotal',
        'diskon',
        'pajak',
        'total',
        'statuscheckout'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(ModelPelanggan::class, 'pelangganid');
    }
}