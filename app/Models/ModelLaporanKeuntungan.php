<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLaporanKeuntungan extends Model
{
    protected $table = 'laporankeuntungan';

    protected $fillable = [
        'userid',
        'tanggal',
        'totalpemasukan',
        'totalpengeluaran',
        'keuntungan',
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