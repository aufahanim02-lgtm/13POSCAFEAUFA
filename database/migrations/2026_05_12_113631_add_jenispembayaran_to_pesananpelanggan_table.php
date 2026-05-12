<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesananpelanggan', function (Blueprint $table) {
            $table->enum('jenispembayaran', ['kasir', 'langsung'])
                  ->default('langsung')
                  ->after('statuspembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesananpelanggan', function (Blueprint $table) {
            $table->dropColumn('jenispembayaran');
        });
    }
};