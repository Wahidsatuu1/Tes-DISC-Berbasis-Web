<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nama Aplikasi
    |--------------------------------------------------------------------------
    |
    | Nilai ini adalah nama aplikasi Anda, yang akan digunakan ketika
    | framework perlu menempatkan nama aplikasi di notifikasi atau
    | elemen UI lainnya di mana nama aplikasi perlu ditampilkan.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Lingkungan Aplikasi
    |--------------------------------------------------------------------------
    |
    | Nilai ini menentukan "lingkungan" (environment) tempat aplikasi Anda
    | saat ini berjalan. Ini mungkin menentukan bagaimana Anda mengonfigurasi
    | berbagai layanan yang digunakan aplikasi. Atur ini di file ".env" Anda.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Mode Debug Aplikasi
    |--------------------------------------------------------------------------
    |
    | Saat aplikasi Anda berada dalam mode debug, pesan kesalahan terperinci
    | dengan stack trace akan ditampilkan di setiap kesalahan yang terjadi
    | di dalam aplikasi Anda. Jika dinonaktifkan, halaman error umum yang sederhana ditampilkan.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL Aplikasi
    |--------------------------------------------------------------------------
    |
    | URL ini digunakan oleh konsol untuk menghasilkan URL dengan benar saat
    | menggunakan tool command line Artisan. Anda harus mengatur ini ke root
    | aplikasi agar tersedia di dalam perintah Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Zona Waktu Aplikasi
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan zona waktu default untuk aplikasi Anda,
    | yang akan digunakan oleh fungsi tanggal dan waktu PHP. Zona waktu
    | diatur ke "UTC" secara default karena cocok untuk sebagian besar kasus.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Lokal (Bahasa) Aplikasi
    |--------------------------------------------------------------------------
    |
    | Lokal aplikasi menentukan lokal default yang akan digunakan oleh
    | metode lokalisasi / terjemahan Laravel. Opsi ini dapat diatur
    | ke lokal apa pun yang Anda rencanakan untuk memiliki string terjemahan.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Kunci Enkripsi (Encryption Key)
    |--------------------------------------------------------------------------
    |
    | Kunci ini digunakan oleh layanan enkripsi Laravel dan harus diatur ke
    | string 32 karakter acak untuk memastikan bahwa semua nilai terenkripsi
    | aman. Anda harus melakukan ini sebelum men-deploy aplikasi.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Driver Mode Pemeliharaan (Maintenance Mode)
    |--------------------------------------------------------------------------
    |
    | Opsi konfigurasi ini menentukan driver yang digunakan untuk menentukan
    | dan mengelola status "maintenance mode" Laravel. Driver "cache"
    | memungkinkan maintenance mode dikendalikan di berbagai mesin (server).
    |
    | Driver yang didukung: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
