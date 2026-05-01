<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class namaseedercafeposraihan extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USER SEED
        |--------------------------------------------------------------------------
        */
        DB::table('user')->insert([
            [
                'name' => 'Owner CAFEPOS',
                'username' => 'owner',
                'email' => 'owner@cafepos.com',
                'password' => Hash::make('123456'),
                'role' => 'owner',
                'foto' => null,
                'isactive' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager CAFEPOS',
                'username' => 'manager',
                'email' => 'manager@cafepos.com',
                'password' => Hash::make('123456'),
                'role' => 'manager',
                'foto' => null,
                'isactive' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir CAFEPOS',
                'username' => 'kasir',
                'email' => 'kasir@cafepos.com',
                'password' => Hash::make('123456'),
                'role' => 'kasir',
                'foto' => null,
                'isactive' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | KATEGORI SEED
        |--------------------------------------------------------------------------
        */
        DB::table('kategori')->insert([
            [
                'namakategori' => 'Minuman',
                'deskripsi' => 'Kategori minuman cafe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namakategori' => 'Makanan',
                'deskripsi' => 'Kategori makanan cafe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namakategori' => 'Snack',
                'deskripsi' => 'Kategori snack cafe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PRODUK SEED
        |--------------------------------------------------------------------------
        */
        DB::table('produk')->insert([
            [
                'kategoriid' => 1,
                'kodeproduk' => 'PRD001',
                'namaproduk' => 'Kopi Susu Gula Aren',
                'hargajual' => 18000,
                'satuan' => 'gelas',
                'foto' => 'produk1.jpg',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoriid' => 2,
                'kodeproduk' => 'PRD002',
                'namaproduk' => 'Nasi Goreng Spesial',
                'hargajual' => 25000,
                'satuan' => 'porsi',
                'foto' => 'produk2.jpg',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoriid' => 1,
                'kodeproduk' => 'PRD003',
                'namaproduk' => 'Es Teh Lemon',
                'hargajual' => 12000,
                'satuan' => 'gelas',
                'foto' => 'produk3.jpg',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | MEJA SEED
        |--------------------------------------------------------------------------
        */
        DB::table('meja')->insert([
            [
                'nomormeja' => 'Meja 01',
                'kapasitas' => 4,
                'status' => 'kosong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomormeja' => 'Meja 02',
                'kapasitas' => 2,
                'status' => 'kosong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomormeja' => 'Meja 03',
                'kapasitas' => 6,
                'status' => 'kosong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | SUPPLIER SEED
        |--------------------------------------------------------------------------
        */
        DB::table('supplier')->insert([
            [
                'namasupplier' => 'Supplier Kopi Nusantara',
                'nohp' => '081234567890',
                'alamat' => 'Medan, Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | METODE PEMBAYARAN SEED
        |--------------------------------------------------------------------------
        */
        DB::table('metodepembayaran')->insert([
            [
                'namametode' => 'Cash',
                'jenis' => 'cash',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namametode' => 'QRIS',
                'jenis' => 'noncash',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namametode' => 'Dana',
                'jenis' => 'noncash',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namametode' => 'Ovo',
                'jenis' => 'noncash',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PAJAK SEED
        |--------------------------------------------------------------------------
        */
        DB::table('pajak')->insert([
            [
                'namapajak' => 'PB1',
                'persen' => 10,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PROMO SEED
        |--------------------------------------------------------------------------
        */
        DB::table('promo')->insert([
            [
                'namapromo' => 'Diskon Kopi 20%',
                'jenis' => 'persen',
                'nilaidiskon' => 20,
                'minimalbelanja' => 0,
                'tanggalmulai' => now()->format('Y-m-d'),
                'tanggalselesai' => now()->addDays(30)->format('Y-m-d'),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | BAHAN BAKU SEED
        |--------------------------------------------------------------------------
        */
        DB::table('bahanbaku')->insert([
            [
                'kodebahan' => 'BB001',
                'namabahan' => 'Biji Kopi',
                'stok' => 50,
                'satuan' => 'kg',
                'hargabeli' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kodebahan' => 'BB002',
                'namabahan' => 'Gula Aren',
                'stok' => 30,
                'satuan' => 'kg',
                'hargabeli' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kodebahan' => 'BB003',
                'namabahan' => 'Susu Fresh',
                'stok' => 20,
                'satuan' => 'liter',
                'hargabeli' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | STOK SEED
        |--------------------------------------------------------------------------
        */
        DB::table('stok')->insert([
            [
                'bahanbakuid' => 1,
                'stoktersedia' => 50,
                'stokminimal' => 10,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bahanbakuid' => 2,
                'stoktersedia' => 30,
                'stokminimal' => 5,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bahanbakuid' => 3,
                'stoktersedia' => 20,
                'stokminimal' => 5,
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | LANDING SEED
        |--------------------------------------------------------------------------
        */
        DB::table('home')->insert([
            [
                'title' => 'Selamat Datang di CAFEPOS',
                'content' => 'CAFEPOS adalah aplikasi kasir modern untuk cafe dan restoran.',
                'statusaktif' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('tentang')->insert([
            [
                'title' => 'Tentang CAFEPOS',
                'content' => 'CAFEPOS adalah sistem POS yang mendukung transaksi, inventory, shift, dan laporan.',
                'statusaktif' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('menu')->insert([
            [
                'produkid' => 1,
                'kategoriid' => 1,
                'statusaktif' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'produkid' => 2,
                'kategoriid' => 2,
                'statusaktif' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'produkid' => 3,
                'kategoriid' => 1,
                'statusaktif' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('promolanding')->insert([
            [
                'promoid' => 1,
                'statusaktif' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}