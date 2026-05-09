<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NamaSeederCafePosRaihan extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // TRUNCATE SEMUA TABLE
        DB::table('kontak')->truncate();
        DB::table('tentang')->truncate();
        DB::table('promolanding')->truncate();
        DB::table('menu')->truncate();
        DB::table('home')->truncate();

        DB::table('zonakasir')->truncate();

        DB::table('laporankeuntungan')->truncate();
        DB::table('laporanshift')->truncate();
        DB::table('laporankasir')->truncate();
        DB::table('laporanproduk')->truncate();
        DB::table('laporanbulanan')->truncate();
        DB::table('laporanharian')->truncate();
        DB::table('laporan')->truncate();

        DB::table('shift')->truncate();

        DB::table('cetakstruk')->truncate();
        DB::table('pembayaran')->truncate();
        DB::table('detailpenjualan')->truncate();
        DB::table('penjualan')->truncate();

        DB::table('detailpembelian')->truncate();
        DB::table('pembelian')->truncate();

        DB::table('stokkeluar')->truncate();
        DB::table('stokmasuk')->truncate();
        DB::table('stok')->truncate();
        DB::table('bahanbaku')->truncate();

        DB::table('pajak')->truncate();
        DB::table('promo')->truncate();
        DB::table('metodepembayaran')->truncate();
        DB::table('supplier')->truncate();
        DB::table('meja')->truncate();
        DB::table('produk')->truncate();
        DB::table('kategori')->truncate();

        DB::table('loginhistory')->truncate();
        DB::table('user')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */
        $ownerId = DB::table('user')->insertGetId([
            'name' => 'Owner Cafe',
            'username' => 'owner',
            'email' => 'owner@cafepos.com',
            'password' => Hash::make('123456'),
            'role' => 'owner',
            'foto' => null,
            'isactive' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $managerId = DB::table('user')->insertGetId([
            'name' => 'Manager Cafe',
            'username' => 'manager',
            'email' => 'manager@cafepos.com',
            'password' => Hash::make('123456'),
            'role' => 'manager',
            'foto' => null,
            'isactive' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kasirId = DB::table('user')->insertGetId([
            'name' => 'Kasir Cafe',
            'username' => 'kasir',
            'email' => 'kasir@cafepos.com',
            'password' => Hash::make('123456'),
            'role' => 'kasir',
            'foto' => null,
            'isactive' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | KATEGORI
        |--------------------------------------------------------------------------
        */
        $kategoriMinumanId = DB::table('kategori')->insertGetId([
            'namakategori' => 'Minuman',
            'deskripsi' => 'Kategori minuman dingin dan panas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kategoriMakananId = DB::table('kategori')->insertGetId([
            'namakategori' => 'Makanan',
            'deskripsi' => 'Kategori makanan berat dan ringan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kategoriSnackId = DB::table('kategori')->insertGetId([
            'namakategori' => 'Snack',
            'deskripsi' => 'Kategori cemilan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PRODUK
        |--------------------------------------------------------------------------
        */
        $produkEsTehId = DB::table('produk')->insertGetId([
            'kategoriid' => $kategoriMinumanId,
            'kodeproduk' => 'PRD001',
            'namaproduk' => 'Es Teh Manis',
            'hargajual' => 5000,
            'satuan' => 'Gelas',
            'foto' => null,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $produkKopiId = DB::table('produk')->insertGetId([
            'kategoriid' => $kategoriMinumanId,
            'kodeproduk' => 'PRD002',
            'namaproduk' => 'Kopi Hitam',
            'hargajual' => 8000,
            'satuan' => 'Cangkir',
            'foto' => null,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $produkNasgorId = DB::table('produk')->insertGetId([
            'kategoriid' => $kategoriMakananId,
            'kodeproduk' => 'PRD003',
            'namaproduk' => 'Nasi Goreng',
            'hargajual' => 15000,
            'satuan' => 'Porsi',
            'foto' => null,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $produkKentangId = DB::table('produk')->insertGetId([
            'kategoriid' => $kategoriSnackId,
            'kodeproduk' => 'PRD004',
            'namaproduk' => 'Kentang Goreng',
            'hargajual' => 12000,
            'satuan' => 'Porsi',
            'foto' => null,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | MEJA
        |--------------------------------------------------------------------------
        */
        $meja1Id = DB::table('meja')->insertGetId([
            'nomormeja' => 'M01',
            'kapasitas' => 4,
            'status' => 'kosong',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $meja2Id = DB::table('meja')->insertGetId([
            'nomormeja' => 'M02',
            'kapasitas' => 2,
            'status' => 'kosong',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | SUPPLIER
        |--------------------------------------------------------------------------
        */
        $supplierId = DB::table('supplier')->insertGetId([
            'namasupplier' => 'Supplier Utama',
            'nohp' => '081234567890',
            'alamat' => 'Jl. Supplier No.1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        $metodeTunaiId = DB::table('metodepembayaran')->insertGetId([
            'namametode' => 'Tunai',
            'jenis' => 'cash',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PAJAK
        |--------------------------------------------------------------------------
        */
        $pajakId = DB::table('pajak')->insertGetId([
            'namapajak' => 'PPN 11%',
            'persen' => 11,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PROMO
        |--------------------------------------------------------------------------
        */
        $promoId = DB::table('promo')->insertGetId([
            'namapromo' => 'Diskon 10%',
            'jenis' => 'persen',
            'nilaidiskon' => 10,
            'minimalbelanja' => 20000,
            'tanggalmulai' => now()->toDateString(),
            'tanggalselesai' => now()->addDays(30)->toDateString(),
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | BAHANBAKU
        |--------------------------------------------------------------------------
        */
        $bahanGulaId = DB::table('bahanbaku')->insertGetId([
            'kodebahan' => 'BB001',
            'namabahan' => 'Gula',
            'stok' => 50,
            'satuan' => 'Kg',
            'hargabeli' => 12000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $bahanKopiId = DB::table('bahanbaku')->insertGetId([
            'kodebahan' => 'BB002',
            'namabahan' => 'Kopi Bubuk',
            'stok' => 20,
            'satuan' => 'Kg',
            'hargabeli' => 80000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $bahanBerasId = DB::table('bahanbaku')->insertGetId([
            'kodebahan' => 'BB003',
            'namabahan' => 'Beras',
            'stok' => 30,
            'satuan' => 'Kg',
            'hargabeli' => 15000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | STOK
        |--------------------------------------------------------------------------
        */
        DB::table('stok')->insert([
            [
                'bahanbakuid' => $bahanGulaId,
                'stoktersedia' => 50,
                'stokminimal' => 10,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bahanbakuid' => $bahanKopiId,
                'stoktersedia' => 20,
                'stokminimal' => 5,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bahanbakuid' => $bahanBerasId,
                'stoktersedia' => 30,
                'stokminimal' => 10,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        /*
|--------------------------------------------------------------------------
| PEMBELIAN
|--------------------------------------------------------------------------
*/
        $pembelianId = DB::table('pembelian')->insertGetId([
            'kodepembelian' => 'PB001',
            'supplierid' => $supplierId,
            'userid' => $managerId, // manager yang input pembelian
            'total' => 500000,
            'tanggalpembelian' => now()->subDays(2)->toDateString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
|--------------------------------------------------------------------------
| DETAIL PEMBELIAN
|--------------------------------------------------------------------------
*/
        DB::table('detailpembelian')->insert([
            [
                'pembelianid' => $pembelianId,
                'bahanbakuid' => $bahanGulaId,
                'qty' => 20,
                'harga' => 12000,
                'subtotal' => 240000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pembelianid' => $pembelianId,
                'bahanbakuid' => $bahanKopiId,
                'qty' => 2,
                'harga' => 80000,
                'subtotal' => 160000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pembelianid' => $pembelianId,
                'bahanbakuid' => $bahanBerasId,
                'qty' => 10,
                'harga' => 15000,
                'subtotal' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
|--------------------------------------------------------------------------
| STOK MASUK 
|--------------------------------------------------------------------------
*/
        DB::table('stokmasuk')->insert([
            [
                'bahanbakuid' => $bahanGulaId,
                'jumlah' => 20,
                'tanggalmasuk' => now()->subDays(2)->toDateString(),
                'keterangan' => 'Pembelian PB001 dari Supplier Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bahanbakuid' => $bahanKopiId,
                'jumlah' => 2,
                'tanggalmasuk' => now()->subDays(2)->toDateString(),
                'keterangan' => 'Pembelian PB001 dari Supplier Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bahanbakuid' => $bahanBerasId,
                'jumlah' => 10,
                'tanggalmasuk' => now()->subDays(2)->toDateString(),
                'keterangan' => 'Pembelian PB001 dari Supplier Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | SHIFT
        |--------------------------------------------------------------------------
        */
        $shiftId = DB::table('shift')->insertGetId([
            'userid' => $kasirId,
            'shiftmulai' => now()->subHours(5),
            'shiftselesai' => null,
            'saldoawal' => 200000,
            'saldoakhir' => null,
            'totaltransaksi' => 0,
            'status' => 'open',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PENJUALAN
        |--------------------------------------------------------------------------
        */
        $penjualanId = DB::table('penjualan')->insertGetId([
            'kodeinvoice' => 'INV001',
            'userid' => $kasirId,
            'mejaid' => $meja1Id,
            'promoid' => $promoId,
            'pajakid' => $pajakId,
            'subtotal' => 25000,
            'diskon' => 2500,
            'pajak' => 2475,
            'total' => 24975,
            'status' => 'paid',
            'tanggalpenjualan' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | DETAIL PENJUALAN
        |--------------------------------------------------------------------------
        */
        DB::table('detailpenjualan')->insert([
            [
                'penjualanid' => $penjualanId,
                'produkid' => $produkEsTehId,
                'qty' => 2,
                'harga' => 5000,
                'subtotal' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'penjualanid' => $penjualanId,
                'produkid' => $produkNasgorId,
                'qty' => 1,
                'harga' => 15000,
                'subtotal' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        DB::table('pembayaran')->insert([
            'penjualanid' => $penjualanId,
            'metodepembayaranid' => $metodeTunaiId,
            'jumlahbayar' => 30000,
            'kembalian' => 5025,
            'tanggalbayar' => now(),
            'buktibayar' => null,
            'status' => 'paid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | CETAK STRUK
        |--------------------------------------------------------------------------
        */
        DB::table('cetakstruk')->insert([
            'penjualanid' => $penjualanId,
            'strukfile' => 'struk_INV001.pdf',
            'tanggalcetak' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN MASTER
        |--------------------------------------------------------------------------
        */
        DB::table('laporan')->insert([
            'userid' => $ownerId,
            'jenislaporan' => 'laporan harian',
            'periodeawal' => now()->toDateString(),
            'periodeakhir' => now()->toDateString(),
            'totaldata' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN HARIAN
        |--------------------------------------------------------------------------
        */
        DB::table('laporanharian')->insert([
            'userid' => $ownerId,
            'tanggal' => now()->toDateString(),
            'totaltransaksi' => 1,
            'totalpendapatan' => 24975,
            'totaldiskon' => 2500,
            'totalpajak' => 2475,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN BULANAN
        |--------------------------------------------------------------------------
        */
        DB::table('laporanbulanan')->insert([
            'userid' => $ownerId,
            'bulan' => now()->format('m'),
            'tahun' => now()->format('Y'),
            'totaltransaksi' => 1,
            'totalpendapatan' => 24975,
            'totaldiskon' => 2500,
            'totalpajak' => 2475,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN PRODUK
        |--------------------------------------------------------------------------
        */
        DB::table('laporanproduk')->insert([
            'userid' => $ownerId,
            'produkid' => $produkEsTehId,
            'totalterjual' => 2,
            'totalpendapatan' => 10000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN KASIR
        |--------------------------------------------------------------------------
        */
        DB::table('laporankasir')->insert([
            'userid' => $ownerId,
            'kasirid' => $kasirId,
            'totaltransaksi' => 1,
            'totalpendapatan' => 24975,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN SHIFT
        |--------------------------------------------------------------------------
        */
        DB::table('laporanshift')->insert([
            'userid' => $ownerId,
            'shiftid' => $shiftId,
            'totaltransaksi' => 1,
            'totalpendapatan' => 24975,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN KEUNTUNGAN
        |--------------------------------------------------------------------------
        */
        DB::table('laporankeuntungan')->insert([
            'userid' => $ownerId,
            'tanggal' => now()->toDateString(),
            'totalpemasukan' => 24975,
            'totalpengeluaran' => 5000,
            'keuntungan' => 19975,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ZONA KASIR
        |--------------------------------------------------------------------------
        */
        DB::table('zonakasir')->insert([
            'userid' => $kasirId,
            'statusaktif' => 'aktif',
            'catatan' => 'Kasir aktif untuk transaksi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LANDING HOME
        |--------------------------------------------------------------------------
        */
        DB::table('home')->insert([
            'title' => 'CAFEPOS - Aplikasi Kasir Cafe Modern',
            'content' => 'Kelola transaksi, stok bahan baku, laporan penjualan, dan shift kasir dengan cepat dan profesional.',
            'statusaktif' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | TENTANG
        |--------------------------------------------------------------------------
        */
        DB::table('tentang')->insert([
            'title' => 'Tentang CAFEPOS',
            'content' => 'CAFEPOS adalah aplikasi kasir cafe yang dibuat untuk membantu bisnis cafe dan restoran modern.',
            'statusaktif' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
