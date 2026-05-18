<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLaporanShift extends Model
{
    protected $table = 'laporanshift';

    protected $fillable = [
        'userid',
        'shiftid',
        'tanggal',
        'totaltransaksi',
        'totalpendapatan',
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

    /*
    |--------------------------------------------------------------------------
    | RELASI SHIFT
    |--------------------------------------------------------------------------
    */

    public function shift()
    {
        return $this->belongsTo(ModelShift::class, 'shiftid');
    }
}