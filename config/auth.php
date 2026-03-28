<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Authentication Defaults
     |--------------------------------------------------------------------------
     */
    'defaults' => [
        'guard' => 'siswa', // Jadikan siswa sebagai default (bisa diganti admin)
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswas',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'siswas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class,
        ]
    ],

];
