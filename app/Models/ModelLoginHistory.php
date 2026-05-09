<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelLoginHistory extends Model
{
    use HasFactory;

    protected $table = 'loginhistory';

    protected $fillable = [
        'userid',
        'ipaddress',
        'useragent',
        'loginat',
        'logoutat',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'userid');
    }
}