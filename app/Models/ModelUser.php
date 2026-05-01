<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ModelUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'foto',
        'isactive'
    ];

    protected $hidden = [
        'password'
    ];
}