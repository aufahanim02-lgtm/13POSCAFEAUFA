<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produkid');
            $table->unsignedBigInteger('bahanbakuid');
            $table->integer('jumlah'); // jumlah bahan baku per 1 produk
            $table->timestamps();

            $table->foreign('produkid')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};