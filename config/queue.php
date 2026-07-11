<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nama Koneksi Antrean (Queue) Bawaan
    |--------------------------------------------------------------------------
    |
    | Antrean Laravel mendukung berbagai backend melalui API tunggal yang
    | disatukan, memberi Anda akses mudah ke setiap backend menggunakan
    | sintaks yang sama untuk masing-masing. Koneksi antrean bawaan ditentukan di bawah.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Koneksi Antrean (Queue Connections)
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat mengonfigurasi opsi koneksi untuk setiap backend antrean
    | yang digunakan oleh aplikasi Anda. Contoh konfigurasi disediakan untuk
    | setiap backend yang didukung oleh Laravel. Anda juga bebas untuk menambahkan lebih banyak.
    |
    | Driver: "sync", "database", "beanstalkd", "sqs", "redis",
    |         "deferred", "background", "failover", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('DB_QUEUE_CONNECTION'),
            'table' => env('DB_QUEUE_TABLE', 'jobs'),
            'queue' => env('DB_QUEUE', 'default'),
            'retry_after' => (int) env('DB_QUEUE_RETRY_AFTER', 90),
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => env('BEANSTALKD_QUEUE_HOST', 'localhost'),
            'queue' => env('BEANSTALKD_QUEUE', 'default'),
            'retry_after' => (int) env('BEANSTALKD_QUEUE_RETRY_AFTER', 90),
            'block_for' => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            'block_for' => null,
            'after_commit' => false,
        ],

        'deferred' => [
            'driver' => 'deferred',
        ],

        'background' => [
            'driver' => 'background',
        ],

        'failover' => [
            'driver' => 'failover',
            'connections' => [
                'database',
                'deferred',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Batching Pekerjaan (Job Batching)
    |--------------------------------------------------------------------------
    |
    | Opsi berikut mengonfigurasi database dan tabel yang menyimpan informasi
    | pengelompokan pekerjaan (batching). Opsi ini dapat diperbarui ke koneksi
    | dan tabel database apa pun yang telah ditentukan oleh aplikasi Anda.
    |
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pekerjaan Antrean yang Gagal (Failed Queue Jobs)
    |--------------------------------------------------------------------------
    |
    | Opsi ini mengonfigurasi perilaku logging pekerjaan antrean yang gagal sehingga
    | Anda dapat mengontrol bagaimana dan di mana pekerjaan yang gagal disimpan. Laravel
    | membawa dukungan untuk menyimpan pekerjaan yang gagal dalam file sederhana atau di database.
    |
    | Driver yang didukung: "database-uuids", "dynamodb", "file", "null"
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'failed_jobs',
    ],

];
