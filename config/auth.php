<?php

use App\Models\ModelUser;
use App\Models\ModelPelanggan;

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | GUARDS
    |--------------------------------------------------------------------------
    */

    'guards' => [

        // LOGIN ADMIN / OWNER / MANAGER / KASIR
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // LOGIN PELANGGAN
        'pelanggan' => [
            'driver' => 'session',
            'provider' => 'pelanggans',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | PROVIDERS
    |--------------------------------------------------------------------------
    */

    'providers' => [

        // USER ADMIN
        'users' => [
            'driver' => 'eloquent',
            'model' => ModelUser::class,
        ],

        // PELANGGAN
        'pelanggans' => [
            'driver' => 'eloquent',
            'model' => ModelPelanggan::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | PASSWORD RESET
    |--------------------------------------------------------------------------
    */

    'passwords' => [

        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'pelanggans' => [
            'provider' => 'pelanggans',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];