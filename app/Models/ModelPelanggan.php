<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ModelPelanggan extends Authenticatable
{
    use Notifiable;

    protected $table = 'pelanggan';

    protected $fillable = [
        'name',          // ✅ FIX: dari "nama" -> "name"
        'username',
        'email',
        'nohp',
        'password',
        'foto',
        'point',
        'levelmember',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}

