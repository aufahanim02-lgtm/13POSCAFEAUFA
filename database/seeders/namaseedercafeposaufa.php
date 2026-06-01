<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class namaseedercafeposaufa extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // kosongkan semua tabel dulu (aman buat migrate:fresh --seed)
        DB::table('loginhistory')->truncate();
        DB::table('wishlist')->truncate();
        DB::table('keranjang')->truncate();
        DB::table('ulasan')->truncate();
        DB::table('checkout')->truncate();
        DB::table('pesananpelanggan')->truncate();
        DB::table('cetakstruk')->truncate();
        DB::table('pembayaran')->truncate();
        DB::table('detailpenjualan')->truncate();
        DB::table('penjualan')->truncate();
        DB::table('shift')->truncate();
        DB::table('detailpembelian')->truncate();
        DB::table('pembelian')->truncate();
        DB::table('stokkeluar')->truncate();
        DB::table('stokmasuk')->truncate();
        DB::table('stok')->truncate();
        DB::table('bahanbaku')->truncate();
        DB::table('zonakasir')->truncate();
        DB::table('laporankeuntungan')->truncate();
        DB::table('laporanshift')->truncate();
        DB::table('laporankasir')->truncate();
        DB::table('laporanproduk')->truncate();
        DB::table('laporanbulanan')->truncate();
        DB::table('laporanharian')->truncate();
        DB::table('laporan')->truncate();
        DB::table('menulanding')->truncate();
        DB::table('promolanding')->truncate();
        DB::table('home')->truncate();
        DB::table('tentang')->truncate();
        DB::table('kontak')->truncate();
        DB::table('produk')->truncate();
        DB::table('kategori')->truncate();
        DB::table('meja')->truncate();
        DB::table('supplier')->truncate();
        DB::table('metodepembayaran')->truncate();
        DB::table('promo')->truncate();
        DB::table('pajak')->truncate();
        DB::table('pelanggan')->truncate();
        DB::table('user')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        /*
        |--------------------------------------------------------------------------
        | USER (OWNER, MANAGER, KASIR)
        |--------------------------------------------------------------------------
        */
        $ownerId = DB::table('user')->insertGetId([
            'name' => 'Owner Cafe',
            'username' => 'owner',
            'email' => 'owner@cafepos.com',
            'nohp' => '081111111111',
            'password' => Hash::make('owner123'),
            'role' => 'owner',
            'foto' => null,
            'isactive' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $managerId = DB::table('user')->insertGetId([
            'name' => 'Manager Cafe',
            'username' => 'manager',
            'email' => 'manager@cafepos.com',
            'nohp' => '082222222222',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
            'foto' => null,
            'isactive' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kasirId = DB::table('user')->insertGetId([
            'name' => 'Kasir Cafe',
            'username' => 'kasir',
            'email' => 'kasir@cafepos.com',
            'nohp' => '083333333333',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
            'foto' => null,
            'isactive' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PELANGGAN
        |--------------------------------------------------------------------------
        */
        $pelangganId = DB::table('pelanggan')->insertGetId([
            'name' => 'Pelanggan Demo',
            'username' => 'pelanggan',
            'email' => 'pelanggan@cafepos.com',
            'nohp' => '085555555555',
            'password' => Hash::make('pelanggan123'),
            'foto' => null,
            'point' => 0,
            'levelmember' => 'silver',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | KATEGORI
        |--------------------------------------------------------------------------
        */
        $kategoriMakanan = DB::table('kategori')->insertGetId([
            'namakategori' => 'Makanan',
            'deskripsi' => 'Menu makanan utama',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kategoriMinuman = DB::table('kategori')->insertGetId([
            'namakategori' => 'Minuman',
            'deskripsi' => 'Menu minuman segar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kategoriSnack = DB::table('kategori')->insertGetId([
            'namakategori' => 'Snack',
            'deskripsi' => 'Cemilan dan makanan ringan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PRODUK
        |--------------------------------------------------------------------------
        */
        $produk1 = DB::table('produk')->insertGetId([
            'kategoriid' => $kategoriMinuman,
            'kodeproduk' => 'PRD-001',
            'namaproduk' => 'Es Teh Manis',
            'deskripsi' => 'Minuman teh manis dingin',
            'hargajual' => 8000,
            'stokproduk' => 100,
            'satuan' => 'gelas',
            'foto' => null,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $produk2 = DB::table('produk')->insertGetId([
            'kategoriid' => $kategoriMinuman,
            'kodeproduk' => 'PRD-002',
            'namaproduk' => 'Kopi Hitam',
            'deskripsi' => 'Kopi hitam panas',
            'hargajual' => 12000,
            'stokproduk' => 100,
            'satuan' => 'gelas',
            'foto' => null,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $produk3 = DB::table('produk')->insertGetId([
            'kategoriid' => $kategoriMakanan,
            'kodeproduk' => 'PRD-003',
            'namaproduk' => 'Nasi Goreng',
            'deskripsi' => 'Nasi goreng spesial',
            'hargajual' => 18000,
            'stokproduk' => 50,
            'satuan' => 'porsi',
            'foto' => null,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $produk4 = DB::table('produk')->insertGetId([
            'kategoriid' => $kategoriSnack,
            'kodeproduk' => 'PRD-004',
            'namaproduk' => 'Kentang Goreng',
            'deskripsi' => 'Kentang goreng renyah',
            'hargajual' => 15000,
            'stokproduk' => 50,
            'satuan' => 'porsi',
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
        for ($i = 1; $i <= 10; $i++) {
            DB::table('meja')->insert([
                'nomormeja' => 'M' . $i,
                'kapasitas' => 4,
                'status' => 'kosong',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SUPPLIER
        |--------------------------------------------------------------------------
        */
        $supplierId = DB::table('supplier')->insertGetId([
            'namasupplier' => 'Supplier Utama Cafe',
            'nohp' => '081234567890',
            'alamat' => 'Medan, Sumatera Utara',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        DB::table('metodepembayaran')->insert([
            [
                'namametode' => 'Cash',
                'jenis' => 'cash',
                'qrcode' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namametode' => 'QRIS',
                'jenis' => 'noncash',
                'qrcode' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PAJAK
        |--------------------------------------------------------------------------
        */
        $pajakId = DB::table('pajak')->insertGetId([
            'namapajak' => 'PPN',
            'persen' => 10,
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
            'namapromo' => 'Promo Grand Opening',
            'jenis' => 'persen',
            'nilaidiskon' => 10,
            'minimalbelanja' => 50000,
            'tanggalmulai' => now()->toDateString(),
            'tanggalselesai' => now()->addDays(30)->toDateString(),
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | BAHAN BAKU
        |--------------------------------------------------------------------------
        */
        $bahan1 = DB::table('bahanbaku')->insertGetId([
            'kodebahan' => 'BB-001',
            'namabahan' => 'Beras',
            'stok' => 50,
            'satuan' => 'kg',
            'hargabeli' => 12000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $bahan2 = DB::table('bahanbaku')->insertGetId([
            'kodebahan' => 'BB-002',
            'namabahan' => 'Teh',
            'stok' => 20,
            'satuan' => 'pak',
            'hargabeli' => 15000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $bahan3 = DB::table('bahanbaku')->insertGetId([
            'kodebahan' => 'BB-003',
            'namabahan' => 'Kopi Bubuk',
            'stok' => 15,
            'satuan' => 'pak',
            'hargabeli' => 30000,
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
                'bahanbakuid' => $bahan1,
                'stoktersedia' => 50,
                'stokminimal' => 10,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bahanbakuid' => $bahan2,
                'stoktersedia' => 20,
                'stokminimal' => 5,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bahanbakuid' => $bahan3,
                'stoktersedia' => 15,
                'stokminimal' => 5,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | LANDING PAGE DATA
        |--------------------------------------------------------------------------
        */
        DB::table('home')->insert([
            'title' => 'Selamat Datang di CAFEPOS',
            'content' => 'CAFEPOS adalah sistem kasir cafe modern untuk pelanggan dan kasir.',
            'statusaktif' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tentang')->insert([
            'title' => 'Tentang CAFEPOS',
            'content' => 'CAFEPOS adalah aplikasi POS cafe dengan fitur lengkap untuk owner, kasir, manager, dan pelanggan.',
            'statusaktif' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kontak')->insert([
            'nama' => 'Admin CAFEPOS',
            'email' => 'admin@cafepos.com',
            'subjek' => 'Kontak Awal',
            'pesan' => 'Silahkan hubungi kami melalui email atau datang langsung ke cafe.',
            'tanggal' => now()->toDateString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menulanding')->insert([
            [
                'produkid' => $produk1,
                'kategoriid' => $kategoriMinuman,
                'statusaktif' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'produkid' => $produk3,
                'kategoriid' => $kategoriMakanan,
                'statusaktif' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('promolanding')->insert([
            'promoid' => $promoId,
            'statusaktif' => 'aktif',
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
            'catatan' => 'Kasir aktif untuk transaksi hari ini.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | SHIFT
        |--------------------------------------------------------------------------
        */
        DB::table('shift')->insert([
            'userid' => $kasirId,
            'shiftmulai' => now(),
            'shiftselesai' => null,
            'saldoawal' => 0,
            'saldoakhir' => 0,
            'totaltransaksi' => 0,
            'status' => 'open',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        }

        


    }

