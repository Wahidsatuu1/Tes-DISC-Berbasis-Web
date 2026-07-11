<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver Sesi Bawaan (Default)
    |--------------------------------------------------------------------------
    |
    | Opsi ini menentukan driver sesi bawaan yang digunakan untuk request
    | yang masuk. Laravel mendukung berbagai opsi penyimpanan untuk
    | menyimpan data sesi. Penyimpanan database adalah pilihan default yang bagus.
    |
    | Didukung: "file", "cookie", "database", "memcached",
    |           "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Masa Pakai Sesi (Lifetime)
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan jumlah menit yang Anda inginkan agar sesi
    | tetap diizinkan untuk menganggur (idle) sebelum kedaluwarsa. Jika Anda
    | ingin sesi langsung kedaluwarsa saat browser ditutup, Anda dapat
    | menentukannya melalui opsi konfigurasi expire_on_close.
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Enkripsi Sesi
    |--------------------------------------------------------------------------
    |
    | Opsi ini memungkinkan Anda dengan mudah menentukan bahwa semua data sesi
    | Anda harus dienkripsi sebelum disimpan. Semua enkripsi dilakukan
    | secara otomatis oleh Laravel dan Anda dapat menggunakan sesi seperti biasa.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Lokasi File Sesi
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan driver sesi "file", file sesi ditempatkan di disk.
    | Lokasi penyimpanan bawaan ditentukan di sini; namun, Anda bebas
    | memberikan lokasi lain tempat file sesi tersebut harus disimpan.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Koneksi Database Sesi
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan driver sesi "database" atau "redis", Anda dapat menentukan
    | koneksi yang harus digunakan untuk mengelola sesi ini. Ini harus
    | sesuai dengan koneksi di opsi konfigurasi database Anda.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Tabel Database Sesi
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan driver sesi "database", Anda dapat menentukan tabel
    | yang digunakan untuk menyimpan sesi. Tentu saja, default yang masuk akal
    | telah ditentukan untuk Anda; namun, Anda dipersilakan untuk mengubahnya.
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Store Cache Sesi
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan salah satu backend sesi berbasis cache bawaan framework,
    | Anda dapat menentukan store cache mana yang harus digunakan untuk menyimpan
    | data sesi di antara permintaan. Ini harus sesuai dengan cache store Anda.
    |
    | Memengaruhi: "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Undian Pembersihan Sesi (Sweeping Lottery)
    |--------------------------------------------------------------------------
    |
    | Beberapa driver sesi harus secara manual menyapu lokasi penyimpanannya
    | untuk membuang sesi lama. Berikut adalah peluang hal itu akan terjadi
    | pada permintaan yang diberikan. Secara default, peluangnya adalah 2 dari 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nama Cookie Sesi
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat mengubah nama cookie sesi yang dibuat oleh framework.
    | Biasanya, Anda tidak perlu mengubah nilai ini karena hal tersebut tidak
    | memberikan peningkatan keamanan yang berarti.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Path Cookie Sesi
    |--------------------------------------------------------------------------
    |
    | Path cookie sesi menentukan path tempat cookie tersebut dianggap tersedia.
    | Biasanya, ini akan menjadi path root aplikasi Anda, tetapi Anda bebas
    | untuk mengubahnya jika diperlukan.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Domain Cookie Sesi
    |--------------------------------------------------------------------------
    |
    | Nilai ini menentukan domain dan subdomain mana cookie sesi ini tersedia.
    | Secara default, cookie akan tersedia untuk domain root tanpa subdomain.
    | Biasanya, ini tidak perlu diubah.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Khusus HTTPS (HTTPS Only Cookies)
    |--------------------------------------------------------------------------
    |
    | Dengan menyetel opsi ini ke true, cookie sesi hanya akan dikirim kembali
    | ke server jika browser memiliki koneksi HTTPS. Ini akan mencegah
    | cookie dikirim ke Anda ketika tidak dapat dilakukan secara aman.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Akses HTTP Saja (HTTP Access Only)
    |--------------------------------------------------------------------------
    |
    | Menyetel nilai ini ke true akan mencegah JavaScript mengakses nilai
    | cookie dan cookie hanya dapat diakses melalui protokol HTTP.
    | Sangat tidak disarankan untuk menonaktifkan opsi ini.
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Cookie Same-Site
    |--------------------------------------------------------------------------
    |
    | Opsi ini menentukan bagaimana cookie Anda berperilaku ketika terjadi
    | permintaan lintas-situs (cross-site), dan dapat digunakan untuk mencegah
    | serangan CSRF. Secara default, kami akan menyetel nilai ini ke "lax"
    | untuk mengizinkan permintaan lintas-situs yang aman.
    |
    | Didukung: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Berpartisi (Partitioned Cookies)
    |--------------------------------------------------------------------------
    |
    | Menyetel nilai ini ke true akan mengikat cookie ke situs tingkat atas (top-level)
    | untuk konteks lintas-situs. Cookie berpartisi diterima oleh browser
    | ketika di-flag "secure" dan atribut Same-Site disetel ke "none".
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

    /*
    |--------------------------------------------------------------------------
    | Serialisasi Sesi
    |--------------------------------------------------------------------------
    |
    | Nilai ini mengontrol strategi serialisasi untuk data sesi, yang secara
    | default adalah JSON. Menyetel ini ke "php" memungkinkan penyimpanan
    | objek PHP dalam sesi tetapi dapat membuat aplikasi rentan terhadap
    | serangan serialisasi "gadget chain" jika APP_KEY bocor.
    |
    | Didukung: "json", "php"
    |
    */

    'serialization' => 'json',

];
