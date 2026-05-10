<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPajak extends Model
{
    protected $table = 'pajak';

    protected $fillable = [
        'namapajak',
        'persentase',
        'status',
    ];
}
