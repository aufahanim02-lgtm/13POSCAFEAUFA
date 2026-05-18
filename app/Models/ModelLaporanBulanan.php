<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLaporanBulanan extends Model
{
    protected $table = 'laporanbulanan';

    protected $fillable = [
        'userid',
        'bulan',
        'tahun',
        'totaltransaksi',
        'totalpendapatan',
        'totaldiskon',
        'totalpajak',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'userid');
    }
}