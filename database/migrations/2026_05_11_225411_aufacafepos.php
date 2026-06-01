<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | MASTER TABLES
        |--------------------------------------------------------------------------
        */

        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->string('nohp', 20)->nullable();
            $table->string('password');
            $table->enum('role', ['owner', 'manager', 'kasir']);
            $table->string('foto')->nullable();
            $table->enum('isactive', ['aktif', 'nonaktif'])->default('aktif');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('nohp', 20)->nullable();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->integer('point')->default(0);
            $table->enum('levelmember', ['silver', 'gold', 'platinum'])->default('silver');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('loginhistory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid')->nullable();
            $table->string('ipaddress', 50)->nullable();
            $table->text('useragent')->nullable();
            $table->timestamp('loginat')->nullable();
            $table->timestamp('logoutat')->nullable();
            $table->enum('status', ['success', 'failed', 'logout'])->default('success');
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->nullOnDelete();
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('namakategori', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategoriid');

            $table->string('kodeproduk', 50)->unique();
            $table->string('namaproduk', 150);
            $table->text('deskripsi')->nullable();
            $table->decimal('hargajual', 12, 2)->default(0);
            $table->integer('stokproduk')->default(0);
            $table->string('satuan', 50)->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

            $table->foreign('kategoriid')->references('id')->on('kategori')->cascadeOnDelete();
        });

        Schema::create('meja', function (Blueprint $table) {
            $table->id();
            $table->string('nomormeja', 20)->unique();
            $table->integer('kapasitas')->default(1);
            $table->enum('status', ['kosong', 'terisi'])->default('kosong');
            $table->timestamps();
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('namasupplier', 150);
            $table->string('nohp', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('metodepembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('namametode', 100);
            $table->enum('jenis', ['cash', 'noncash'])->default('cash');
            $table->string('qrcode')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('promo', function (Blueprint $table) {
            $table->id();
            $table->string('namapromo', 150);
            $table->enum('jenis', ['persen', 'fixed'])->default('persen');
            $table->decimal('nilaidiskon', 12, 2)->default(0);
            $table->decimal('minimalbelanja', 12, 2)->default(0);
            $table->date('tanggalmulai');
            $table->date('tanggalselesai');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('pajak', function (Blueprint $table) {
            $table->id();
            $table->string('namapajak', 100);
            $table->decimal('persen', 5, 2)->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | INVENTORY TABLES
        |--------------------------------------------------------------------------
        */

        Schema::create('bahanbaku', function (Blueprint $table) {
            $table->id();
            $table->string('kodebahan', 50)->unique();
            $table->string('namabahan', 150);
            $table->integer('stok')->default(0);
            $table->string('satuan', 50)->nullable();
            $table->decimal('hargabeli', 12, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('stok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bahanbakuid');
            $table->integer('stoktersedia')->default(0);
            $table->integer('stokminimal')->default(0);
            $table->enum('status', ['aman', 'habis'])->default('aman');
            $table->timestamps();

            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->cascadeOnDelete();
        });

        Schema::create('stokmasuk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bahanbakuid');
            $table->integer('jumlah')->default(0);
            $table->date('tanggalmasuk');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->cascadeOnDelete();
        });

        Schema::create('stokkeluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bahanbakuid');
            $table->integer('jumlah')->default(0);
            $table->date('tanggalkeluar');
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->cascadeOnDelete();
        });

        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('kodepembelian', 50)->unique();
            $table->unsignedBigInteger('supplierid');
            $table->unsignedBigInteger('userid');
            $table->decimal('total', 12, 2)->default(0);
            $table->date('tanggalpembelian');
            $table->timestamps();

            $table->foreign('supplierid')->references('id')->on('supplier')->cascadeOnDelete();
            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
        });

        Schema::create('detailpembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembelianid');
            $table->unsignedBigInteger('bahanbakuid');
            $table->integer('qty')->default(0);
            $table->decimal('harga', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->timestamps();

            $table->foreign('pembelianid')->references('id')->on('pembelian')->cascadeOnDelete();
            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->cascadeOnDelete();
        });

        /*
        |--------------------------------------------------------------------------
        | SHIFT TABLE
        |--------------------------------------------------------------------------
        */

        Schema::create('shift', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');

            $table->timestamp('shiftmulai')->nullable();
            $table->timestamp('shiftselesai')->nullable();

            $table->decimal('saldoawal', 12, 2)->default(0);
            $table->decimal('saldoakhir', 12, 2)->default(0);

            $table->integer('totaltransaksi')->default(0);
            $table->enum('status', ['open', 'closed'])->default('open');

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
        });

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI (POS)
        |--------------------------------------------------------------------------
        */

        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();

            $table->string('kodeinvoice', 50)->unique();

            $table->unsignedBigInteger('userid')->nullable();
            $table->unsignedBigInteger('pelangganid')->nullable();

            $table->unsignedBigInteger('shiftid')->nullable();
            $table->unsignedBigInteger('mejaid')->nullable();

            $table->unsignedBigInteger('promoid')->nullable();
            $table->unsignedBigInteger('pajakid')->nullable();

            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('pajak', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->enum('sumberpesanan', ['kasir', 'pelanggan'])->default('kasir');

            $table->enum('statuspesanan', [
                'menunggu',
                'diproses',
                'siapdiambil',
                'selesai',
                'dibatalkan'
            ])->default('menunggu');

            $table->enum('statuspembayaran', ['belumbayar', 'lunas'])->default('belumbayar');

            $table->enum('status', ['pending', 'paid'])->default('pending');

            $table->timestamp('tanggalpenjualan')->nullable();

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->nullOnDelete();
            $table->foreign('pelangganid')->references('id')->on('pelanggan')->nullOnDelete();
            $table->foreign('shiftid')->references('id')->on('shift')->nullOnDelete();
            $table->foreign('mejaid')->references('id')->on('meja')->nullOnDelete();
            $table->foreign('promoid')->references('id')->on('promo')->nullOnDelete();
            $table->foreign('pajakid')->references('id')->on('pajak')->nullOnDelete();
        });

        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualanid');
            $table->unsignedBigInteger('produkid');

            $table->integer('qty')->default(1);
            $table->decimal('harga', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);

            $table->enum('statusitem', ['tersedia', 'habis'])->default('tersedia');

            $table->timestamps();

            $table->foreign('penjualanid')->references('id')->on('penjualan')->cascadeOnDelete();
            $table->foreign('produkid')->references('id')->on('produk')->cascadeOnDelete();
        });

        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('penjualanid');
            $table->unsignedBigInteger('metodepembayaranid');

            $table->decimal('jumlahbayar', 12, 2)->default(0);
            $table->decimal('kembalian', 12, 2)->default(0);

            $table->timestamp('tanggalbayar')->nullable();
            $table->string('buktibayar')->nullable();

            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');

            $table->timestamps();

            $table->foreign('penjualanid')->references('id')->on('penjualan')->cascadeOnDelete();
            $table->foreign('metodepembayaranid')->references('id')->on('metodepembayaran')->cascadeOnDelete();
        });

        Schema::create('cetakstruk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualanid');
            $table->string('strukfile')->nullable();
            $table->timestamp('tanggalcetak')->nullable();
            $table->timestamps();

            $table->foreign('penjualanid')->references('id')->on('penjualan')->cascadeOnDelete();
        });

        /*
        |--------------------------------------------------------------------------
        | PELANGGAN TABLES
        |--------------------------------------------------------------------------
        */

        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelangganid');
            $table->unsignedBigInteger('produkid');

            $table->integer('qty')->default(1);
            $table->decimal('harga', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('pelangganid')->references('id')->on('pelanggan')->cascadeOnDelete();
            $table->foreign('produkid')->references('id')->on('produk')->cascadeOnDelete();
        });

        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelangganid');
            $table->unsignedBigInteger('produkid');
            $table->timestamps();

            $table->foreign('pelangganid')->references('id')->on('pelanggan')->cascadeOnDelete();
            $table->foreign('produkid')->references('id')->on('produk')->cascadeOnDelete();

            $table->unique(['pelangganid', 'produkid']);
        });

        Schema::create('ulasan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelangganid');
            $table->unsignedBigInteger('produkid');

            $table->tinyInteger('rating')->default(5);
            $table->text('komentar')->nullable();
            $table->date('tanggal')->nullable();

            $table->timestamps();

            $table->foreign('pelangganid')->references('id')->on('pelanggan')->cascadeOnDelete();
            $table->foreign('produkid')->references('id')->on('produk')->cascadeOnDelete();
        });

        Schema::create('checkout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelangganid');

            $table->string('kodecheckout', 50)->unique();

            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('pajak', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->enum('statuscheckout', ['pending', 'confirm'])->default('pending');

            $table->timestamps();

            $table->foreign('pelangganid')->references('id')->on('pelanggan')->cascadeOnDelete();
        });

        Schema::create('pesananpelanggan', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pelangganid');
            $table->unsignedBigInteger('penjualanid');
            $table->unsignedBigInteger('mejaid')->nullable();

            $table->enum('statuspesanan', [
                'menunggu',
                'diproses',
                'siapdiambil',
                'selesai',
                'dibatalkan'
            ])->default('menunggu');

            $table->enum('statuspembayaran', ['belumbayar', 'lunas'])->default('belumbayar');

            $table->timestamp('tanggalpesan')->nullable();

            $table->timestamps();

            $table->foreign('pelangganid')->references('id')->on('pelanggan')->cascadeOnDelete();
            $table->foreign('penjualanid')->references('id')->on('penjualan')->cascadeOnDelete();
            $table->foreign('mejaid')->references('id')->on('meja')->nullOnDelete();
        });

        /*
        |--------------------------------------------------------------------------
        | LAPORAN TABLES
        |--------------------------------------------------------------------------
        */

        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');

            $table->string('jenislaporan', 50);
            $table->date('periodeawal')->nullable();
            $table->date('periodeakhir')->nullable();

            $table->integer('totaldata')->default(0);

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
        });

        Schema::create('laporanharian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');

            $table->date('tanggal');

            $table->integer('totaltransaksi')->default(0);
            $table->decimal('totalpendapatan', 12, 2)->default(0);
            $table->decimal('totaldiskon', 12, 2)->default(0);
            $table->decimal('totalpajak', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
        });

        Schema::create('laporanbulanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');

            $table->integer('bulan');
            $table->integer('tahun');

            $table->integer('totaltransaksi')->default(0);
            $table->decimal('totalpendapatan', 12, 2)->default(0);
            $table->decimal('totaldiskon', 12, 2)->default(0);
            $table->decimal('totalpajak', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
        });

        Schema::create('laporanproduk', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('produkid');

            $table->integer('totalterjual')->default(0);
            $table->decimal('totalpendapatan', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
            $table->foreign('produkid')->references('id')->on('produk')->cascadeOnDelete();
        });

        Schema::create('laporankasir', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('kasirid');

            $table->date('tanggal');

            $table->integer('totaltransaksi')->default(0);
            $table->decimal('totalpendapatan', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
            $table->foreign('kasirid')->references('id')->on('user')->cascadeOnDelete();
        });

        Schema::create('laporanshift', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('shiftid');

            $table->date('tanggal');

            $table->integer('totaltransaksi')->default(0);
            $table->decimal('totalpendapatan', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
            $table->foreign('shiftid')->references('id')->on('shift')->cascadeOnDelete();
        });

        Schema::create('laporankeuntungan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');

            $table->date('tanggal');

            $table->decimal('totalpemasukan', 12, 2)->default(0);
            $table->decimal('totalpengeluaran', 12, 2)->default(0);
            $table->decimal('keuntungan', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
        });

        /*
        |--------------------------------------------------------------------------
        | ZONA KASIR
        |--------------------------------------------------------------------------
        */

        Schema::create('zonakasir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('nonaktif');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->cascadeOnDelete();
        });

        /*
        |--------------------------------------------------------------------------
        | LANDING TABLES
        |--------------------------------------------------------------------------
        */

        Schema::create('home', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('content')->nullable();
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('menulanding', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produkid');
            $table->unsignedBigInteger('kategoriid');
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('produkid')->references('id')->on('produk')->cascadeOnDelete();
            $table->foreign('kategoriid')->references('id')->on('kategori')->cascadeOnDelete();
        });

        Schema::create('promolanding', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promoid');
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('promoid')->references('id')->on('promo')->cascadeOnDelete();
        });

        Schema::create('tentang', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('content')->nullable();
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('email', 100);
            $table->string('subjek', 150);
            $table->text('pesan');
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | DROP TABLES (REVERSE ORDER)
        |--------------------------------------------------------------------------
        */

        Schema::dropIfExists('kontak');
        Schema::dropIfExists('tentang');
        Schema::dropIfExists('promolanding');
        Schema::dropIfExists('menulanding');
        Schema::dropIfExists('home');

        Schema::dropIfExists('zonakasir');

        Schema::dropIfExists('laporankeuntungan');
        Schema::dropIfExists('laporanshift');
        Schema::dropIfExists('laporankasir');
        Schema::dropIfExists('laporanproduk');
        Schema::dropIfExists('laporanbulanan');
        Schema::dropIfExists('laporanharian');
        Schema::dropIfExists('laporan');

        Schema::dropIfExists('pesananpelanggan');
        Schema::dropIfExists('checkout');
        Schema::dropIfExists('ulasan');
        Schema::dropIfExists('wishlist');
        Schema::dropIfExists('keranjang');

        Schema::dropIfExists('cetakstruk');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('detailpenjualan');
        Schema::dropIfExists('penjualan');

        Schema::dropIfExists('shift');

        Schema::dropIfExists('detailpembelian');
        Schema::dropIfExists('pembelian');

        Schema::dropIfExists('stokkeluar');
        Schema::dropIfExists('stokmasuk');
        Schema::dropIfExists('stok');
        Schema::dropIfExists('bahanbaku');

        Schema::dropIfExists('pajak');
        Schema::dropIfExists('promo');
        Schema::dropIfExists('metodepembayaran');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('meja');

        Schema::dropIfExists('produk');
        Schema::dropIfExists('kategori');

        Schema::dropIfExists('loginhistory');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('user');
    }
};