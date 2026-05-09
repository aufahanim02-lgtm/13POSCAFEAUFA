<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('metodepembayaran', function (Blueprint $table) {

            $table->string('qrcode')->nullable()->after('status');

        });
    }

    public function down(): void
    {
        Schema::table('metodepembayaran', function (Blueprint $table) {

            $table->dropColumn('qrcode');

        });
    }
};