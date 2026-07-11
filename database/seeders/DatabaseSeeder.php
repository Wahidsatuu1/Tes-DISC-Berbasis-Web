<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Jalankan seed (pengisi data) untuk database aplikasi.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            DiscQuestionSeeder::class,
        ]);
    }
}
