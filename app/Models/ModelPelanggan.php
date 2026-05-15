<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ModelPelanggan extends Authenticatable
{
    use Notifiable;

    protected $table = 'pelanggan';

    protected $fillable = [
        'name',
        'username',
        'email',
        'nohp',
        'password',
        'foto',
        'point',
        'levelmember',
        'status',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'point' => 'integer',
    ];
    public function penjualan()
    {
        return $this->hasMany(\App\Models\ModelPenjualan::class, 'pelangganid');
    }
}
