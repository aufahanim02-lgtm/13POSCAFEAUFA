<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | MASTER: USER
        |--------------------------------------------------------------------------
        */
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->enum('role', ['owner', 'manager', 'kasir'])->default('kasir');
            $table->string('foto')->nullable();
            $table->enum('isactive', ['active', 'nonactive'])->default('active');
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | AUTH: LOGIN HISTORY
        |--------------------------------------------------------------------------
        */
        Schema::create('loginhistory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid')->nullable();
            $table->string('ipaddress')->nullable();
            $table->text('useragent')->nullable();
            $table->dateTime('loginat')->nullable();
            $table->dateTime('logoutat')->nullable();
            $table->enum('status', ['success', 'failed'])->default('success');
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('set null');
        });

        /*
        |--------------------------------------------------------------------------
        | MASTER: KATEGORI
        |--------------------------------------------------------------------------
        */
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('namakategori');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | MASTER: PRODUK
        |--------------------------------------------------------------------------
        */
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategoriid');
            $table->string('kodeproduk')->unique();
            $table->string('namaproduk');
            $table->decimal('hargajual', 15, 2)->default(0);
            $table->string('satuan')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('kategoriid')->references('id')->on('kategori')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | MASTER: MEJA
        |--------------------------------------------------------------------------
        */
        Schema::create('meja', function (Blueprint $table) {
            $table->id();
            $table->string('nomormeja')->unique();
            $table->integer('kapasitas')->default(1);
            $table->enum('status', ['kosong', 'terisi'])->default('kosong');
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | MASTER: SUPPLIER
        |--------------------------------------------------------------------------
        */
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('namasupplier');
            $table->string('nohp')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | MASTER: METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        Schema::create('metodepembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('namametode');
            $table->enum('jenis', ['cash', 'noncash'])->default('cash');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | MASTER: PROMO
        |--------------------------------------------------------------------------
        */
        Schema::create('promo', function (Blueprint $table) {
            $table->id();
            $table->string('namapromo');
            $table->enum('jenis', ['persen', 'fixed'])->default('persen');
            $table->decimal('nilaidiskon', 15, 2)->default(0);
            $table->decimal('minimalbelanja', 15, 2)->nullable();
            $table->date('tanggalmulai')->nullable();
            $table->date('tanggalselesai')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | MASTER: PAJAK
        |--------------------------------------------------------------------------
        */
        Schema::create('pajak', function (Blueprint $table) {
            $table->id();
            $table->string('namapajak');
            $table->decimal('persen', 5, 2)->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | INVENTORY: BAHAN BAKU
        |--------------------------------------------------------------------------
        */
        Schema::create('bahanbaku', function (Blueprint $table) {
            $table->id();
            $table->string('kodebahan')->unique();
            $table->string('namabahan');
            $table->decimal('stok', 15, 2)->default(0);
            $table->string('satuan')->nullable();
            $table->decimal('hargabeli', 15, 2)->default(0);
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | INVENTORY: STOK
        |--------------------------------------------------------------------------
        */
        Schema::create('stok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bahanbakuid');
            $table->decimal('stoktersedia', 15, 2)->default(0);
            $table->decimal('stokminimal', 15, 2)->default(0);
            $table->enum('status', ['aman', 'habis'])->default('aman');
            $table->timestamps();

            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | INVENTORY: STOK MASUK
        |--------------------------------------------------------------------------
        */
        Schema::create('stokmasuk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bahanbakuid');
            $table->decimal('jumlah', 15, 2)->default(0);
            $table->date('tanggalmasuk')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | INVENTORY: STOK KELUAR
        |--------------------------------------------------------------------------
        */
        Schema::create('stokkeluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bahanbakuid');
            $table->decimal('jumlah', 15, 2)->default(0);
            $table->date('tanggalkeluar')->nullable();
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | INVENTORY: PEMBELIAN
        |--------------------------------------------------------------------------
        */
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplierid');
            $table->unsignedBigInteger('userid');
            $table->decimal('total', 15, 2)->default(0);
            $table->date('tanggalpembelian')->nullable();
            $table->timestamps();

            $table->foreign('supplierid')->references('id')->on('supplier')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | INVENTORY: DETAIL PEMBELIAN
        |--------------------------------------------------------------------------
        */
        Schema::create('detailpembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembelianid');
            $table->unsignedBigInteger('bahanbakuid');
            $table->decimal('qty', 15, 2)->default(0);
            $table->decimal('harga', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('pembelianid')->references('id')->on('pembelian')->onDelete('cascade');
            $table->foreign('bahanbakuid')->references('id')->on('bahanbaku')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI: PENJUALAN
        |--------------------------------------------------------------------------
        */
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('kodeinvoice')->unique();
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('mejaid')->nullable();
            $table->unsignedBigInteger('promoid')->nullable();
            $table->unsignedBigInteger('pajakid')->nullable();
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('pajak', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->dateTime('tanggalpenjualan')->nullable();
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('mejaid')->references('id')->on('meja')->onDelete('set null');
            $table->foreign('promoid')->references('id')->on('promo')->onDelete('set null');
            $table->foreign('pajakid')->references('id')->on('pajak')->onDelete('set null');
        });

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI: DETAIL PENJUALAN
        |--------------------------------------------------------------------------
        */
        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualanid');
            $table->unsignedBigInteger('produkid');
            $table->decimal('qty', 15, 2)->default(0);
            $table->decimal('harga', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('penjualanid')->references('id')->on('penjualan')->onDelete('cascade');
            $table->foreign('produkid')->references('id')->on('produk')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI: PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualanid');
            $table->unsignedBigInteger('metodepembayaranid');
            $table->decimal('jumlahbayar', 15, 2)->default(0);
            $table->decimal('kembalian', 15, 2)->default(0);
            $table->string('buktibayar')->nullable();
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();

            $table->foreign('penjualanid')->references('id')->on('penjualan')->onDelete('cascade');
            $table->foreign('metodepembayaranid')->references('id')->on('metodepembayaran')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI: CETAK STRUK
        |--------------------------------------------------------------------------
        */
        Schema::create('cetakstruk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualanid');
            $table->string('strukfile')->nullable();
            $table->dateTime('tanggalcetak')->nullable();
            $table->timestamps();

            $table->foreign('penjualanid')->references('id')->on('penjualan')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | SHIFT
        |--------------------------------------------------------------------------
        */
        Schema::create('shift', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->dateTime('shiftmulai')->nullable();
            $table->dateTime('shiftselesai')->nullable();
            $table->decimal('saldoawal', 15, 2)->default(0);
            $table->decimal('saldoakhir', 15, 2)->nullable();
            $table->integer('totaltransaksi')->default(0);
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | LAPORAN
        |--------------------------------------------------------------------------
        */
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->string('jenislaporan');
            $table->date('periodeawal')->nullable();
            $table->date('periodeakhir')->nullable();
            $table->integer('totaldata')->default(0);
            $table->dateTime('createdat')->nullable();
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
        });

        Schema::create('laporanharian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->date('tanggal')->nullable();
            $table->integer('totaltransaksi')->default(0);
            $table->decimal('totalpendapatan', 15, 2)->default(0);
            $table->decimal('totaldiskon', 15, 2)->default(0);
            $table->decimal('totalpajak', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
        });

        Schema::create('laporanbulanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('totaltransaksi')->default(0);
            $table->decimal('totalpendapatan', 15, 2)->default(0);
            $table->decimal('totaldiskon', 15, 2)->default(0);
            $table->decimal('totalpajak', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
        });

        Schema::create('laporanproduk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('produkid');
            $table->decimal('totalterjual', 15, 2)->default(0);
            $table->decimal('totalpendapatan', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('produkid')->references('id')->on('produk')->onDelete('cascade');
        });

        Schema::create('laporankasir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('kasirid');
            $table->integer('totaltransaksi')->default(0);
            $table->decimal('totalpendapatan', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('kasirid')->references('id')->on('user')->onDelete('cascade');
        });

        Schema::create('laporanshift', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('shiftid');
            $table->integer('totaltransaksi')->default(0);
            $table->decimal('totalpendapatan', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('shiftid')->references('id')->on('shift')->onDelete('cascade');
        });

        Schema::create('laporankeuntungan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->date('tanggal')->nullable();
            $table->decimal('totalpemasukan', 15, 2)->default(0);
            $table->decimal('totalpengeluaran', 15, 2)->default(0);
            $table->decimal('keuntungan', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | ZONA KASIR
        |--------------------------------------------------------------------------
        */
        Schema::create('zonakasir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade');
        });

        /*
        |--------------------------------------------------------------------------
        | LANDING PAGE
        |--------------------------------------------------------------------------
        */
        Schema::create('home', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produkid')->nullable();
            $table->unsignedBigInteger('kategoriid')->nullable();
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('produkid')->references('id')->on('produk')->onDelete('set null');
            $table->foreign('kategoriid')->references('id')->on('kategori')->onDelete('set null');
        });

        Schema::create('promolanding', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promoid')->nullable();
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('promoid')->references('id')->on('promo')->onDelete('set null');
        });

        Schema::create('tentang', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->enum('statusaktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('subjek');
            $table->text('pesan');
            $table->dateTime('tanggal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak');
        Schema::dropIfExists('tentang');
        Schema::dropIfExists('promolanding');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('home');

        Schema::dropIfExists('zonakasir');

        Schema::dropIfExists('laporankeuntungan');
        Schema::dropIfExists('laporanshift');
        Schema::dropIfExists('laporankasir');
        Schema::dropIfExists('laporanproduk');
        Schema::dropIfExists('laporanbulanan');
        Schema::dropIfExists('laporanharian');
        Schema::dropIfExists('laporan');

        Schema::dropIfExists('shift');

        Schema::dropIfExists('cetakstruk');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('detailpenjualan');
        Schema::dropIfExists('penjualan');

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
        Schema::dropIfExists('user');
    }
};