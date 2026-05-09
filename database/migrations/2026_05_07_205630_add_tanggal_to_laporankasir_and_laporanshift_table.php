<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ===============================
        // TAMBAH KOLOM TANGGAL LAPORAN KASIR
        // ===============================
        Schema::table('laporankasir', function (Blueprint $table) {
            if (!Schema::hasColumn('laporankasir', 'tanggal')) {
                $table->date('tanggal')->nullable()->after('kasirid');
            }
        });

        // ===============================
        // TAMBAH KOLOM TANGGAL LAPORAN SHIFT
        // ===============================
        Schema::table('laporanshift', function (Blueprint $table) {
            if (!Schema::hasColumn('laporanshift', 'tanggal')) {
                $table->date('tanggal')->nullable()->after('shiftid');
            }
        });

        // ===============================
        // TAMBAH INDEX UNTUK MEMPERCEPAT QUERY
        // ===============================
        Schema::table('laporankasir', function (Blueprint $table) {
            $table->index(['kasirid', 'tanggal']);
        });

        Schema::table('laporanshift', function (Blueprint $table) {
            $table->index(['shiftid', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::table('laporankasir', function (Blueprint $table) {
            if (Schema::hasColumn('laporankasir', 'tanggal')) {
                $table->dropIndex(['kasirid', 'tanggal']);
                $table->dropColumn('tanggal');
            }
        });

        Schema::table('laporanshift', function (Blueprint $table) {
            if (Schema::hasColumn('laporanshift', 'tanggal')) {
                $table->dropIndex(['shiftid', 'tanggal']);
                $table->dropColumn('tanggal');
            }
        });
    }
};
