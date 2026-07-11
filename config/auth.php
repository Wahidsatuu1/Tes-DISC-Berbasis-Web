<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Bawaan (Default) Autentikasi
    |--------------------------------------------------------------------------
    |
    | Opsi ini menentukan "guard" autentikasi dan "broker" reset password
    | bawaan untuk aplikasi Anda. Anda dapat mengubah nilai ini sesuai
    | kebutuhan, namun ini adalah awalan yang sempurna untuk banyak aplikasi.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Guard Autentikasi
    |--------------------------------------------------------------------------
    |
    | Selanjutnya, Anda dapat menentukan setiap guard autentikasi untuk aplikasi
    | Anda. Tentu saja, konfigurasi default yang bagus telah ditentukan untuk
    | Anda yang menggunakan penyimpanan sesi (session) dan provider pengguna Eloquent.
    |
    | Semua guard autentikasi memiliki provider pengguna, yang menentukan
    | bagaimana pengguna sebenarnya diambil dari database Anda atau sistem
    | penyimpanan lain yang digunakan oleh aplikasi. Biasanya, Eloquent digunakan.
    |
    | Didukung: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Provider Pengguna
    |--------------------------------------------------------------------------
    |
    | Semua guard autentikasi memiliki provider pengguna, yang menentukan
    | bagaimana pengguna sebenarnya diambil dari database Anda atau sistem
    | penyimpanan lain yang digunakan oleh aplikasi. Biasanya, Eloquent digunakan.
    |
    | Jika Anda memiliki beberapa tabel atau model pengguna, Anda dapat
    | mengonfigurasi beberapa provider untuk mewakili model / tabel tersebut.
    | Provider ini kemudian dapat ditetapkan ke guard autentikasi tambahan apa pun.
    |
    | Didukung: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
    |
    | Opsi konfigurasi ini menentukan perilaku fitur reset password Laravel,
    | termasuk tabel yang digunakan untuk penyimpanan token dan provider
    | pengguna yang dipanggil untuk benar-benar mengambil pengguna.
    |
    | Waktu kedaluwarsa (expire) adalah jumlah menit setiap token reset akan
    | dianggap valid. Fitur keamanan ini membuat masa pakai token menjadi
    | singkat sehingga peluang untuk ditebak lebih kecil.
    |
    | Pengaturan throttle adalah jumlah detik yang harus ditunggu pengguna
    | sebelum membuat token reset password lagi. Ini mencegah pengguna
    | membuat token dalam jumlah yang sangat banyak dengan cepat.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Batas Waktu Konfirmasi Password
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan jumlah detik sebelum jendela konfirmasi
    | password berakhir dan pengguna diminta memasukkan kembali password mereka
    | melalui layar konfirmasi. Secara default, batas waktu ini berlangsung tiga jam.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
