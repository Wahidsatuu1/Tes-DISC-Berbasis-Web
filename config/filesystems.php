<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disk Filesystem Bawaan (Default)
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan disk filesystem default yang harus digunakan
    | oleh framework. Disk "local", serta berbagai disk berbasis cloud
    | tersedia untuk aplikasi Anda sebagai tempat penyimpanan file.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Disk Filesystem
    |--------------------------------------------------------------------------
    |
    | Di bawah ini Anda dapat mengonfigurasi sebanyak mungkin disk filesystem,
    | dan Anda bahkan dapat mengonfigurasi beberapa disk untuk driver yang sama.
    | Contoh untuk sebagian besar driver yang didukung ada di sini sebagai referensi.
    |
    | Driver yang didukung: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Tautan Simbolik (Symbolic Links)
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat mengonfigurasi tautan simbolik yang akan dibuat ketika
    | perintah Artisan `storage:link` dijalankan. Kunci array harus berupa
    | lokasi tautan dan nilainya harus berupa targetnya.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
