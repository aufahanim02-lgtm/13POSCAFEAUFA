<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelPelanggan;
use App\Models\ModelUser;
use App\Models\ModelMeja;
use App\Models\ModelShift;
use App\Models\ModelPromo;
use App\Models\ModelPajak;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelPembayaran;

class ModelPenjualan extends Model
{
    protected $table = 'penjualan';

   protected $fillable = [
    'kodeinvoice',
    'userid',
    'pelangganid',
    'shiftid',
    'mejaid',
    'promoid',
    'pajakid',
    'subtotal',
    'diskon',
    'pajak',
    'total',
    'sumberpesanan',
    'statuspesanan',
    'statuspembayaran',

    // 🔥 PAYMENT SYSTEM FIX
  'payment_gateway',
    'qris_reference',
    'statuspembayaran',
    'statuspesanan',

    'status',
    'tanggalpenjualan'
];

    public function pelanggan()
    {
        return $this->belongsTo(ModelPelanggan::class, 'pelangganid');
    }

    public function kasir()
    {
        return $this->belongsTo(ModelUser::class, 'userid');
    }

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'userid');
    }

    public function meja()
    {
        return $this->belongsTo(ModelMeja::class, 'mejaid');
    }

    public function shift()
    {
        return $this->belongsTo(ModelShift::class, 'shiftid');
    }

    public function promo()
    {
        return $this->belongsTo(ModelPromo::class, 'promoid');
    }

    public function pajakData()
    {
        return $this->belongsTo(ModelPajak::class, 'pajakid');
    }

    public function detail()
    {
        return $this->hasMany(ModelDetailPenjualan::class, 'penjualanid');
    }

    public function pembayaran()
    {
        return $this->hasOne(ModelPembayaran::class, 'penjualanid');
    }
}