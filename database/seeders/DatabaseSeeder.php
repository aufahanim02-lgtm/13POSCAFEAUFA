<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// ✅ Import seeder dengan nama class yang BENAR
use Database\Seeders\namaseedercafeposaufa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder utama
        $this->call(namaseedercafeposaufa::class);
    }
}