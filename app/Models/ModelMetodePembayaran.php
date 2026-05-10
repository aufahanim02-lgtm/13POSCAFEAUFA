<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMetodePembayaran extends Model
{
    protected $table = 'metodepembayaran';

    protected $fillable = [
        'namametode',
        'jenis',
        'status',
        'qrcode',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // SATU METODE BISA DIGUNAKAN BANYAK PEMBAYARAN
    public function pembayaran()
    {
        return $this->hasMany(
            ModelPembayaran::class,
            'metodepembayaranid',
            'id'
        );
    }
}