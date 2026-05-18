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
        'totalpendapatan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI USER PEMBUAT LAPORAN
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'userid');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KASIR
    |--------------------------------------------------------------------------
    */

    public function kasir()
    {
        return $this->belongsTo(ModelUser::class, 'kasirid');
    }
}