<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@equity.com'],
            [
                'name' => 'Karyawan Equity',
                'password' => Hash::make('equity123'),
                'role' => 'admin',
                'position' => 'HR Manager'
            ]
        );
    }
}
