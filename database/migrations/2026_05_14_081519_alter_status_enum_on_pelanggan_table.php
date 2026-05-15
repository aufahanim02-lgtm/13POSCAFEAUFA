<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pelanggan MODIFY status ENUM('aktif','nonaktif','blocked') NOT NULL DEFAULT 'aktif'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pelanggan MODIFY status ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif'");
    }
};