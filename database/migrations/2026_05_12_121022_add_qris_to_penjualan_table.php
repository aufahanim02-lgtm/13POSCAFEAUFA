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
        Schema::table('penjualan', function (Blueprint $table) {
            $table->string('qris_reference')->nullable()->after('status');
            $table->enum('payment_gateway', ['cash', 'qris'])
                  ->default('cash')
                  ->after('qris_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn('qris_reference');
            $table->dropColumn('payment_gateway');
        });
    }
};