<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCetakStruk extends Model
{
    use HasFactory;

    protected $table = 'cetakstruk';

    protected $fillable = [
        'penjualanid',
        'strukfile',
        'tanggalcetak'
    ];
}