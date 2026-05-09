<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLaporanKasir extends Model
{
    protected $table = 'laporankasir';

    protected $fillable = [
        'userid',
        'kasirid',
        'tanggal',
        'totaltransaksi',
        'totalpendapatan'
    ];

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'userid', 'id');
    }

    public function kasir()
    {
        return $this->belongsTo(ModelUser::class, 'kasirid', 'id');
    }
}
