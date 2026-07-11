<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Store Cache Bawaan (Default)
    |--------------------------------------------------------------------------
    |
    | Opsi ini mengontrol store cache default yang akan digunakan oleh
    | framework. Koneksi ini digunakan jika tidak ada koneksi lain yang
    | ditentukan secara eksplisit saat menjalankan operasi cache di dalam aplikasi.
    |
    */

    'default' => env('CACHE_STORE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Store Cache
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan semua "store" cache untuk aplikasi Anda beserta
    | dengan driver-nya. Anda bahkan dapat menentukan beberapa store untuk
    | driver cache yang sama guna mengelompokkan jenis item yang disimpan.
    |
    | Driver yang didukung: "array", "database", "file", "memcached",
    |                       "redis", "dynamodb", "storage", "octane",
    |                       "session", "failover", "null"
    |
    */

    'stores' => [

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('DB_CACHE_CONNECTION'),
            'table' => env('DB_CACHE_TABLE', 'cache'),
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION'),
            'lock_table' => env('DB_CACHE_LOCK_TABLE'),
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
            'lock_path' => storage_path('framework/cache/data'),
        ],

        'storage' => [
            'driver' => 'storage',
            'disk' => env('CACHE_STORAGE_DISK'),
            'path' => env('CACHE_STORAGE_PATH', 'framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
            'lock_connection' => env('REDIS_CACHE_LOCK_CONNECTION', 'default'),
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

        'octane' => [
            'driver' => 'octane',
        ],

        'failover' => [
            'driver' => 'failover',
            'stores' => [
                'database',
                'array',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Prefiks (Awalan) Kunci Cache
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan store cache APC, database, memcached, Redis, dan DynamoDB,
    | mungkin ada aplikasi lain yang menggunakan cache yang sama. Untuk
    | alasan itu, Anda dapat memberi awalan pada setiap kunci cache agar tidak bertabrakan.
    |
    */

    'prefix' => env('CACHE_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-cache-'),

    /*
    |--------------------------------------------------------------------------
    | Kelas yang Dapat Diserialisasi
    |--------------------------------------------------------------------------
    |
    | Nilai ini menentukan kelas yang dapat di-unserialize dari penyimpanan
    | cache. Secara default, tidak ada kelas PHP yang akan di-unserialize dari
    | cache Anda untuk mencegah serangan gadget chain jika APP_KEY Anda bocor.
    |
    */

    'serializable_classes' => false,

];
