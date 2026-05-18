<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLaporanHarian extends Model
{
    protected $table = 'laporanharian';

    protected $fillable = [
        'userid',
        'tanggal',
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