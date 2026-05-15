<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS (BY FITUR)
|--------------------------------------------------------------------------
*/

// LANDING
use App\Http\Controllers\Landing\ControllerLanding;

// AUTH
use App\Http\Controllers\Auth\ControllerAuthUser;
use App\Http\Controllers\Auth\ControllerAuthLoginHistory;
use App\Http\Controllers\Auth\ControllerAuthPelanggan;

// DASHBOARD
use App\Http\Controllers\Dashboard\ControllerDashboardOwner;
use App\Http\Controllers\Dashboard\ControllerDashboardManager;
use App\Http\Controllers\Dashboard\ControllerDashboardKasir;
use App\Http\Controllers\Dashboard\ControllerDashboardPelanggan;

// MASTER
use App\Http\Controllers\Master\ControllerUser;
use App\Http\Controllers\Master\ControllerKategori;
use App\Http\Controllers\Master\ControllerProduk;
use App\Http\Controllers\Master\ControllerMeja;
use App\Http\Controllers\Master\ControllerSupplier;
use App\Http\Controllers\Master\ControllerMetodePembayaran;
use App\Http\Controllers\Master\ControllerPromo;
use App\Http\Controllers\Master\ControllerPajak;
use App\Http\Controllers\Master\ControllerUlasanOwner;
use App\Http\Controllers\Master\ControllerPelangganAdmin;

// INVENTORY
use App\Http\Controllers\Inventory\ControllerBahanBaku;
use App\Http\Controllers\Inventory\ControllerStok;
use App\Http\Controllers\Inventory\ControllerStokMasuk;
use App\Http\Controllers\Inventory\ControllerStokKeluar;
use App\Http\Controllers\Inventory\ControllerPembelian;

// TRANSAKSI
use App\Http\Controllers\Transaksi\ControllerPenjualan;
use App\Http\Controllers\Transaksi\ControllerCetakStruk;
use App\Http\Controllers\Transaksi\ControllerRiwayatKasir;
use App\Http\Controllers\Transaksi\ControllerShift;
use App\Http\Controllers\Transaksi\ControllerPesananMasukKasir;
use App\Http\Controllers\Transaksi\ControllerPembayaranKasir;

// LAPORAN
use App\Http\Controllers\Laporan\ControllerLaporan;
use App\Http\Controllers\Laporan\ControllerLaporanHarian;
use App\Http\Controllers\Laporan\ControllerLaporanBulanan;
use App\Http\Controllers\Laporan\ControllerLaporanProduk;
use App\Http\Controllers\Laporan\ControllerLaporanKasir;
use App\Http\Controllers\Laporan\ControllerLaporanShift;
use App\Http\Controllers\Laporan\ControllerLaporanKeuntungan;

// PELANGGAN
use App\Http\Controllers\Pelanggan\ControllerMenuPelanggan;
use App\Http\Controllers\Pelanggan\ControllerKeranjang;
use App\Http\Controllers\Pelanggan\ControllerCheckout;
use App\Http\Controllers\Pelanggan\ControllerPesananPelanggan;
use App\Http\Controllers\Pelanggan\ControllerWishlist;
use App\Http\Controllers\Pelanggan\ControllerUlasan;
use App\Http\Controllers\Pelanggan\ControllerProfilPelanggan;

// ZONA KASIR
use App\Http\Controllers\ZonaKasir\ControllerZonaKasir;


/*
|--------------------------------------------------------------------------
| LANDING PAGE (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [ControllerLanding::class, 'home'])->name('landing.home');
Route::get('/menu', [ControllerLanding::class, 'menu'])->name('landing.menu');
Route::get('/promo', [ControllerLanding::class, 'promo'])->name('landing.promo');
Route::get('/tentang', [ControllerLanding::class, 'tentang'])->name('landing.tentang');
Route::get('/kontak', [ControllerLanding::class, 'kontak'])->name('landing.kontak');
Route::post('/kontak', [ControllerLanding::class, 'storeKontak'])->name('landing.kontak.store');


/*
|--------------------------------------------------------------------------
| AUTH USER (ADMIN / OWNER / MANAGER / KASIR)
|--------------------------------------------------------------------------
*/
Route::get('/login', [ControllerAuthUser::class, 'login'])->name('auth.login');
Route::post('/login', [ControllerAuthUser::class, 'loginProses'])->name('auth.loginproses');
Route::get('/logout', [ControllerAuthUser::class, 'logout'])->name('auth.logout');

Route::get('/pilih-login', function () {
    return view('auth.pilihlogin');
})->name('auth.pilihlogin');


/*
|--------------------------------------------------------------------------
| AUTH PELANGGAN
|--------------------------------------------------------------------------
*/
Route::get('/loginpelanggan', [ControllerAuthPelanggan::class, 'login'])->name('pelanggan.login');
Route::post('/loginpelanggan', [ControllerAuthPelanggan::class, 'loginProses'])->name('pelanggan.login.proses');

Route::get('/registerpelanggan', [ControllerAuthPelanggan::class, 'register'])->name('pelanggan.register');
Route::post('/registerpelanggan', [ControllerAuthPelanggan::class, 'registerProses'])->name('pelanggan.register.proses');

Route::get('/logoutpelanggan', [ControllerAuthPelanggan::class, 'logout'])->name('pelanggan.logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES (ADMIN / OWNER / MANAGER / KASIR)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:owner'])->group(function () {
        Route::get('/dashboardowner', [ControllerDashboardOwner::class, 'index'])->name('dashboard.owner');
    });

    Route::middleware(['role:manager'])->group(function () {
        Route::get('/dashboardmanager', [ControllerDashboardManager::class, 'index'])->name('dashboard.manager');
    });

    Route::middleware(['role:kasir'])->group(function () {
        Route::get('/dashboardkasir', [ControllerDashboardKasir::class, 'index'])->name('dashboard.kasir');
    });


    /*
    |--------------------------------------------------------------------------
    | LOGIN HISTORY (OWNER ONLY)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:owner'])->group(function () {
        Route::get('/loginhistory', [ControllerAuthLoginHistory::class, 'index'])->name('loginhistory.index');
        Route::get('/loginhistory/{id}', [ControllerAuthLoginHistory::class, 'show'])->name('loginhistory.show');
        Route::delete('/loginhistory/{id}', [ControllerAuthLoginHistory::class, 'destroy'])->name('loginhistory.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | MASTER DATA (OWNER ONLY)
    |--------------------------------------------------------------------------
    */
    Route::prefix('master')->middleware(['role:owner'])->group(function () {

        // USER
        Route::get('/user', [ControllerUser::class, 'index'])->name('master.user.index');
        Route::get('/user/create', [ControllerUser::class, 'create'])->name('master.user.create');
        Route::post('/user', [ControllerUser::class, 'store'])->name('master.user.store');
        Route::get('/user/{id}', [ControllerUser::class, 'show'])->name('master.user.show');
        Route::get('/user/{id}/edit', [ControllerUser::class, 'edit'])->name('master.user.edit');
        Route::put('/user/{id}', [ControllerUser::class, 'update'])->name('master.user.update');
        Route::delete('/user/{id}', [ControllerUser::class, 'destroy'])->name('master.user.destroy');

        // KATEGORI
        Route::get('/kategori', [ControllerKategori::class, 'index'])->name('master.kategori.index');
        Route::get('/kategori/create', [ControllerKategori::class, 'create'])->name('master.kategori.create');
        Route::post('/kategori', [ControllerKategori::class, 'store'])->name('master.kategori.store');
        Route::get('/kategori/{id}', [ControllerKategori::class, 'show'])->name('master.kategori.show');
        Route::get('/kategori/{id}/edit', [ControllerKategori::class, 'edit'])->name('master.kategori.edit');
        Route::put('/kategori/{id}', [ControllerKategori::class, 'update'])->name('master.kategori.update');
        Route::delete('/kategori/{id}', [ControllerKategori::class, 'destroy'])->name('master.kategori.destroy');

        // PRODUK
        Route::get('/produk', [ControllerProduk::class, 'index'])->name('master.produk.index');
        Route::get('/produk/create', [ControllerProduk::class, 'create'])->name('master.produk.create');
        Route::post('/produk', [ControllerProduk::class, 'store'])->name('master.produk.store');
        Route::get('/produk/{id}', [ControllerProduk::class, 'show'])->name('master.produk.show');
        Route::get('/produk/{id}/edit', [ControllerProduk::class, 'edit'])->name('master.produk.edit');
        Route::put('/produk/{id}', [ControllerProduk::class, 'update'])->name('master.produk.update');
        Route::delete('/produk/{id}', [ControllerProduk::class, 'destroy'])->name('master.produk.destroy');

        // MEJA
        Route::get('/meja', [ControllerMeja::class, 'index'])->name('master.meja.index');
        Route::get('/meja/create', [ControllerMeja::class, 'create'])->name('master.meja.create');
        Route::post('/meja', [ControllerMeja::class, 'store'])->name('master.meja.store');
        Route::get('/meja/{id}', [ControllerMeja::class, 'show'])->name('master.meja.show');
        Route::get('/meja/{id}/edit', [ControllerMeja::class, 'edit'])->name('master.meja.edit');
        Route::put('/meja/{id}', [ControllerMeja::class, 'update'])->name('master.meja.update');
        Route::delete('/meja/{id}', [ControllerMeja::class, 'destroy'])->name('master.meja.destroy');

        // SUPPLIER
        Route::get('/supplier', [ControllerSupplier::class, 'index'])->name('master.supplier.index');
        Route::get('/supplier/create', [ControllerSupplier::class, 'create'])->name('master.supplier.create');
        Route::post('/supplier', [ControllerSupplier::class, 'store'])->name('master.supplier.store');
        Route::get('/supplier/{id}', [ControllerSupplier::class, 'show'])->name('master.supplier.show');
        Route::get('/supplier/{id}/edit', [ControllerSupplier::class, 'edit'])->name('master.supplier.edit');
        Route::put('/supplier/{id}', [ControllerSupplier::class, 'update'])->name('master.supplier.update');
        Route::delete('/supplier/{id}', [ControllerSupplier::class, 'destroy'])->name('master.supplier.destroy');

        // METODE PEMBAYARAN
        Route::get('/metodepembayaran', [ControllerMetodePembayaran::class, 'index'])->name('master.metodepembayaran.index');
        Route::get('/metodepembayaran/create', [ControllerMetodePembayaran::class, 'create'])->name('master.metodepembayaran.create');
        Route::post('/metodepembayaran', [ControllerMetodePembayaran::class, 'store'])->name('master.metodepembayaran.store');
        Route::get('/metodepembayaran/{id}/edit', [ControllerMetodePembayaran::class, 'edit'])->name('master.metodepembayaran.edit');
        Route::put('/metodepembayaran/{id}', [ControllerMetodePembayaran::class, 'update'])->name('master.metodepembayaran.update');
        Route::delete('/metodepembayaran/{id}', [ControllerMetodePembayaran::class, 'destroy'])->name('master.metodepembayaran.destroy');

        // PROMO
        Route::get('/promo', [ControllerPromo::class, 'index'])->name('master.promo.index');
        Route::get('/promo/create', [ControllerPromo::class, 'create'])->name('master.promo.create');
        Route::post('/promo', [ControllerPromo::class, 'store'])->name('master.promo.store');
        Route::get('/promo/{id}', [ControllerPromo::class, 'show'])->name('master.promo.show');
        Route::get('/promo/{id}/edit', [ControllerPromo::class, 'edit'])->name('master.promo.edit');
        Route::put('/promo/{id}', [ControllerPromo::class, 'update'])->name('master.promo.update');
        Route::delete('/promo/{id}', [ControllerPromo::class, 'destroy'])->name('master.promo.destroy');

        // PAJAK
        Route::get('/pajak', [ControllerPajak::class, 'index'])->name('master.pajak.index');
        Route::get('/pajak/create', [ControllerPajak::class, 'create'])->name('master.pajak.create');
        Route::post('/pajak', [ControllerPajak::class, 'store'])->name('master.pajak.store');
        Route::get('/pajak/{id}', [ControllerPajak::class, 'show'])->name('master.pajak.show');
        Route::get('/pajak/{id}/edit', [ControllerPajak::class, 'edit'])->name('master.pajak.edit');
        Route::put('/pajak/{id}', [ControllerPajak::class, 'update'])->name('master.pajak.update');
        Route::delete('/pajak/{id}', [ControllerPajak::class, 'destroy'])->name('master.pajak.destroy');

        // ULASAN
        Route::get('/ulasan', [ControllerUlasanOwner::class, 'index'])->name('admin.ulasan.index');
        Route::get('/ulasan/{id}', [ControllerUlasanOwner::class, 'show'])->name('admin.ulasan.show');
        Route::delete('/ulasan/{id}', [ControllerUlasanOwner::class, 'destroy'])->name('admin.ulasan.destroy');

        // RESEP PRODUK
        Route::get('/resep', [\App\Http\Controllers\Master\ControllerResep::class, 'index'])
            ->name('master.resep.index');

        Route::get('/resep/{produkid}', [\App\Http\Controllers\Master\ControllerResep::class, 'show'])
            ->name('master.resep.show');

        Route::post('/resep/{produkid}', [\App\Http\Controllers\Master\ControllerResep::class, 'store'])
            ->name('master.resep.store');

        Route::get('/resep/edit/{id}', [\App\Http\Controllers\Master\ControllerResep::class, 'edit'])
            ->name('master.resep.edit');

        Route::put('/resep/update/{id}', [\App\Http\Controllers\Master\ControllerResep::class, 'update'])
            ->name('master.resep.update');

        Route::delete('/resep/delete/{id}', [\App\Http\Controllers\Master\ControllerResep::class, 'destroy'])
            ->name('master.resep.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN PELANGGAN (OWNER + MANAGER)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(['role:owner,manager'])->group(function () {

        Route::get('/pelanggan', [ControllerPelangganAdmin::class, 'index'])
            ->name('admin.pelanggan.index');

        Route::get('/pelanggan/{id}', [ControllerPelangganAdmin::class, 'show'])
            ->name('admin.pelanggan.show');

        Route::post('/pelanggan/{id}/blokir', [ControllerPelangganAdmin::class, 'blokir'])
            ->name('admin.pelanggan.blokir');

        Route::post('/pelanggan/{id}/aktifkan', [ControllerPelangganAdmin::class, 'aktifkan'])
            ->name('admin.pelanggan.aktifkan');

        Route::delete('/pelanggan/{id}', [ControllerPelangganAdmin::class, 'destroy'])
            ->name('admin.pelanggan.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | INVENTORY (OWNER + MANAGER)
    |--------------------------------------------------------------------------
    */
    Route::prefix('inventory')->middleware(['role:owner,manager'])->group(function () {

        Route::get('/bahanbaku', [ControllerBahanBaku::class, 'index'])->name('inventory.bahanbaku.index');
        Route::get('/bahanbaku/create', [ControllerBahanBaku::class, 'create'])->name('inventory.bahanbaku.create');
        Route::post('/bahanbaku', [ControllerBahanBaku::class, 'store'])->name('inventory.bahanbaku.store');
        Route::get('/bahanbaku/{id}', [ControllerBahanBaku::class, 'show'])->name('inventory.bahanbaku.show');
        Route::get('/bahanbaku/{id}/edit', [ControllerBahanBaku::class, 'edit'])->name('inventory.bahanbaku.edit');
        Route::put('/bahanbaku/{id}', [ControllerBahanBaku::class, 'update'])->name('inventory.bahanbaku.update');
        Route::delete('/bahanbaku/{id}', [ControllerBahanBaku::class, 'destroy'])->name('inventory.bahanbaku.destroy');

        Route::get('/stok', [ControllerStok::class, 'index'])->name('inventory.stok.index');
        Route::get('/stok/create', [ControllerStok::class, 'create'])->name('inventory.stok.create');
        Route::post('/stok', [ControllerStok::class, 'store'])->name('inventory.stok.store');
        Route::get('/stok/{id}', [ControllerStok::class, 'show'])->name('inventory.stok.show');
        Route::get('/stok/{id}/edit', [ControllerStok::class, 'edit'])->name('inventory.stok.edit');
        Route::put('/stok/{id}', [ControllerStok::class, 'update'])->name('inventory.stok.update');
        Route::delete('/stok/{id}', [ControllerStok::class, 'destroy'])->name('inventory.stok.destroy');

        Route::get('/stokmasuk', [ControllerStokMasuk::class, 'index'])->name('inventory.stokmasuk.index');
        Route::get('/stokmasuk/create', [ControllerStokMasuk::class, 'create'])->name('inventory.stokmasuk.create');
        Route::post('/stokmasuk', [ControllerStokMasuk::class, 'store'])->name('inventory.stokmasuk.store');
        Route::get('/stokmasuk/{id}', [ControllerStokMasuk::class, 'show'])->name('inventory.stokmasuk.show');
        Route::get('/stokmasuk/{id}/edit', [ControllerStokMasuk::class, 'edit'])->name('inventory.stokmasuk.edit');
        Route::put('/stokmasuk/{id}', [ControllerStokMasuk::class, 'update'])->name('inventory.stokmasuk.update');
        Route::delete('/stokmasuk/{id}', [ControllerStokMasuk::class, 'destroy'])->name('inventory.stokmasuk.destroy');

        Route::get('/stokkeluar', [ControllerStokKeluar::class, 'index'])->name('inventory.stokkeluar.index');
        Route::get('/stokkeluar/create', [ControllerStokKeluar::class, 'create'])->name('inventory.stokkeluar.create');
        Route::post('/stokkeluar', [ControllerStokKeluar::class, 'store'])->name('inventory.stokkeluar.store');
        Route::get('/stokkeluar/{id}', [ControllerStokKeluar::class, 'show'])->name('inventory.stokkeluar.show');
        Route::get('/stokkeluar/{id}/edit', [ControllerStokKeluar::class, 'edit'])->name('inventory.stokkeluar.edit');
        Route::put('/stokkeluar/{id}', [ControllerStokKeluar::class, 'update'])->name('inventory.stokkeluar.update');
        Route::delete('/stokkeluar/{id}', [ControllerStokKeluar::class, 'destroy'])->name('inventory.stokkeluar.destroy');

        Route::get('/pembelian', [ControllerPembelian::class, 'index'])->name('inventory.pembelian.index');
        Route::get('/pembelian/create', [ControllerPembelian::class, 'create'])->name('inventory.pembelian.create');
        Route::post('/pembelian', [ControllerPembelian::class, 'store'])->name('inventory.pembelian.store');
        Route::get('/pembelian/{id}', [ControllerPembelian::class, 'show'])->name('inventory.pembelian.show');
        Route::get('/pembelian/{id}/edit', [ControllerPembelian::class, 'edit'])->name('inventory.pembelian.edit');
        Route::put('/pembelian/{id}', [ControllerPembelian::class, 'update'])->name('inventory.pembelian.update');
        Route::delete('/pembelian/{id}', [ControllerPembelian::class, 'destroy'])->name('inventory.pembelian.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT TRANSAKSI (OWNER + MANAGER)
    |--------------------------------------------------------------------------
    */
    Route::prefix('transaksi')->middleware(['role:owner,manager'])->group(function () {
        Route::get('/riwayat', [ControllerRiwayatKasir::class, 'adminIndex'])->name('transaksi.riwayat.index');
        Route::get('/riwayat/{id}', [ControllerRiwayatKasir::class, 'adminShow'])->name('transaksi.riwayat.show');
    });


    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI KASIR
    |--------------------------------------------------------------------------
    */
    Route::prefix('kasir')->middleware(['role:kasir'])->group(function () {

        // PESANAN MASUK
        Route::get('/pesananmasuk', [ControllerPesananMasukKasir::class, 'index'])
            ->name('kasir.pesananmasuk.index');

        Route::get('/pesananmasuk/{id}', [ControllerPesananMasukKasir::class, 'detail'])
            ->name('kasir.pesananmasuk.show');

        Route::post('/pesananmasuk/{id}/diproses', [ControllerPesananMasukKasir::class, 'setDiproses'])
            ->name('kasir.pesananmasuk.diproses');

        Route::post('/pesananmasuk/{id}/siap', [ControllerPesananMasukKasir::class, 'setSiapDiambil'])
            ->name('kasir.pesananmasuk.siap');

        Route::post('/pesananmasuk/{id}/selesai', [ControllerPesananMasukKasir::class, 'setSelesai'])
            ->name('kasir.pesananmasuk.selesai');

        Route::post('/pesananmasuk/{id}/batalkan', [ControllerPesananMasukKasir::class, 'batalkan'])
            ->name('kasir.pesananmasuk.batalkan');

        // PEMBAYARAN PESANAN PELANGGAN
        Route::get('/pembayaranpelanggan', [ControllerPembayaranKasir::class, 'index'])
            ->name('kasir.pembayaranpelanggan.index');

        Route::get('/pembayaranpelanggan/{id}', [ControllerPembayaranKasir::class, 'form'])
            ->name('kasir.pembayaranpelanggan.form');

        Route::post('/pembayaranpelanggan/{id}', [ControllerPembayaranKasir::class, 'proses'])
            ->name('kasir.pembayaranpelanggan.proses');

        Route::get('/pembayaranpelanggan/qris/{id}', [ControllerPembayaranKasir::class, 'qris'])
            ->name('kasir.pembayaranpelanggan.qris');

        Route::post('/pembayaranpelanggan/qris/{id}/konfirmasi', [ControllerPembayaranKasir::class, 'konfirmasiQris'])
            ->name('kasir.pembayaranpelanggan.qris.konfirmasi');


        // POS MANUAL
        Route::get('/pos', [ControllerPenjualan::class, 'index'])->name('kasir.pos');
        Route::post('/pos/tambah', [ControllerPenjualan::class, 'tambah'])->name('kasir.pos.tambah');
        Route::post('/pos/hapus', [ControllerPenjualan::class, 'hapus'])->name('kasir.pos.hapus');
        Route::post('/pos/reset', [ControllerPenjualan::class, 'reset'])->name('kasir.pos.reset');

        Route::get('/pembayaran', [ControllerPenjualan::class, 'pembayaran'])->name('kasir.pembayaran.index');
        Route::post('/pembayaran/proses', [ControllerPenjualan::class, 'proses'])->name('kasir.pembayaran.proses');

        Route::get('/sukses/{id}', [ControllerPenjualan::class, 'sukses'])->name('kasir.sukses');

        // RIWAYAT
        Route::get('/riwayat', [ControllerRiwayatKasir::class, 'index'])->name('kasir.riwayat.index');
        Route::get('/riwayat/{id}', [ControllerRiwayatKasir::class, 'show'])->name('kasir.riwayat.show');

        // CETAK STRUK
        Route::get('/cetakstruk', [ControllerCetakStruk::class, 'index'])->name('kasir.cetakstruk.index');
        Route::get('/cetakstruk/print/{id}', [ControllerCetakStruk::class, 'print'])->name('kasir.cetakstruk.print');
        Route::get('/cetakstruk/{id}', [ControllerCetakStruk::class, 'show'])->name('kasir.cetakstruk.show');

        // SHIFT
        Route::get('/shift', [ControllerShift::class, 'index'])->name('kasir.shift.index');
        Route::get('/shift/buka', [ControllerShift::class, 'bukaShift'])->name('kasir.shift.buka');
        Route::post('/shift/buka/proses', [ControllerShift::class, 'prosesBukaShift'])->name('kasir.shift.buka.proses');
        Route::get('/shift/tutup', [ControllerShift::class, 'tutupShift'])->name('kasir.shift.tutup');
        Route::post('/shift/tutup/proses', [ControllerShift::class, 'prosesTutupShift'])->name('kasir.shift.tutup.proses');
    });


    /*
|--------------------------------------------------------------------------
| MASTER KHUSUS OWNER + MANAGER
|--------------------------------------------------------------------------
*/
    Route::prefix('manager')->middleware(['role:owner,manager'])->group(function () {

        /*
    |--------------------------------------------------------------------------
    | MEJA
    |--------------------------------------------------------------------------
    */
        Route::get('/meja', [ControllerMeja::class, 'index'])
            ->name('manager.meja.index');

        Route::get('/meja/create', [ControllerMeja::class, 'create'])
            ->name('manager.meja.create');

        Route::post('/meja', [ControllerMeja::class, 'store'])
            ->name('manager.meja.store');

        Route::get('/meja/{id}', [ControllerMeja::class, 'show'])
            ->name('manager.meja.show');

        Route::get('/meja/{id}/edit', [ControllerMeja::class, 'edit'])
            ->name('manager.meja.edit');

        Route::put('/meja/{id}', [ControllerMeja::class, 'update'])
            ->name('manager.meja.update');

        Route::delete('/meja/{id}', [ControllerMeja::class, 'destroy'])
            ->name('manager.meja.destroy');


        /*
    |--------------------------------------------------------------------------
    | DATA PELANGGAN
    |--------------------------------------------------------------------------
    */
        Route::get('/pelanggan', [ControllerPelangganAdmin::class, 'index'])
            ->name('manager.pelanggan.index');

        Route::get('/pelanggan/{id}', [ControllerPelangganAdmin::class, 'show'])
            ->name('manager.pelanggan.show');

        Route::post('/pelanggan/{id}/blokir', [ControllerPelangganAdmin::class, 'blokir'])
            ->name('manager.pelanggan.blokir');

        Route::post('/pelanggan/{id}/aktifkan', [ControllerPelangganAdmin::class, 'aktifkan'])
            ->name('manager.pelanggan.aktifkan');

        Route::delete('/pelanggan/{id}', [ControllerPelangganAdmin::class, 'destroy'])
            ->name('manager.pelanggan.destroy');


        /*
    |--------------------------------------------------------------------------
    | ULASAN
    |--------------------------------------------------------------------------
    */
        Route::get('/ulasan', [ControllerUlasanOwner::class, 'index'])
            ->name('manager.ulasan.index');

        Route::get('/ulasan/{id}', [ControllerUlasanOwner::class, 'show'])
            ->name('manager.ulasan.show');

        Route::delete('/ulasan/{id}', [ControllerUlasanOwner::class, 'destroy'])
            ->name('manager.ulasan.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | LAPORAN (OWNER + MANAGER)
    |--------------------------------------------------------------------------
    */
    Route::prefix('laporan')->middleware(['role:owner,manager'])->group(function () {

        Route::get('/', [ControllerLaporan::class, 'index'])->name('laporan.index');

        Route::get('/harian', [ControllerLaporanHarian::class, 'index'])->name('laporan.harian.index');
        Route::get('/harian/{id}', [ControllerLaporanHarian::class, 'show'])->name('laporan.harian.show');

        Route::get('/bulanan', [ControllerLaporanBulanan::class, 'index'])->name('laporan.bulanan.index');
        Route::get('/bulanan/{id}', [ControllerLaporanBulanan::class, 'show'])->name('laporan.bulanan.show');

        Route::get('/produk', [ControllerLaporanProduk::class, 'index'])->name('laporan.produk.index');
        Route::get('/produk/{id}', [ControllerLaporanProduk::class, 'show'])->name('laporan.produk.show');

        Route::get('/kasir', [ControllerLaporanKasir::class, 'index'])->name('laporan.kasir.index');
        Route::get('/kasir/{id}', [ControllerLaporanKasir::class, 'show'])->name('laporan.kasir.show');

        Route::get('/shift', [ControllerLaporanShift::class, 'index'])->name('laporan.shift.index');
        Route::get('/shift/{id}', [ControllerLaporanShift::class, 'show'])->name('laporan.shift.show');

        Route::get('/keuntungan', [ControllerLaporanKeuntungan::class, 'index'])->name('laporan.keuntungan.index');
        Route::get('/keuntungan/{id}', [ControllerLaporanKeuntungan::class, 'show'])->name('laporan.keuntungan.show');
    });


    /*
    |--------------------------------------------------------------------------
    | ZONA KASIR (OWNER ONLY)
    |--------------------------------------------------------------------------
    */
    Route::prefix('zonakasir')->middleware(['role:owner'])->group(function () {
        Route::get('/', [ControllerZonaKasir::class, 'index'])->name('zonakasir.index');
        Route::post('/aktifkan/{id}', [ControllerZonaKasir::class, 'aktifkan'])->name('zonakasir.aktifkan');
        Route::post('/nonaktifkan/{id}', [ControllerZonaKasir::class, 'nonaktifkan'])->name('zonakasir.nonaktifkan');
    });
});


/*
|--------------------------------------------------------------------------
| PELANGGAN ROUTES (LOGIN PELANGGAN)
|--------------------------------------------------------------------------
*/
Route::prefix('pelanggan')
    ->middleware(['pelanggan'])
    ->name('pelanggan.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [ControllerDashboardPelanggan::class, 'index'])->name('dashboard');

        // PROFIL
        Route::get('/profil', [ControllerProfilPelanggan::class, 'index'])->name('profil.index');
        Route::get('/profil/edit', [ControllerProfilPelanggan::class, 'edit'])->name('profil.edit');
        Route::put('/profil/update', [ControllerProfilPelanggan::class, 'update'])->name('profil.update');

        // MENU
        Route::get('/menu', [ControllerMenuPelanggan::class, 'index'])->name('menu.index');
        Route::get('/menu/{id}', [ControllerMenuPelanggan::class, 'detail'])->name('menu.detail');

        // KERANJANG
        Route::get('/keranjang', [ControllerKeranjang::class, 'index'])->name('keranjang.index');
        Route::post('/keranjang/tambah/{id}', [ControllerKeranjang::class, 'tambah'])->name('keranjang.tambah');
        Route::delete('/keranjang/hapus/{id}', [ControllerKeranjang::class, 'hapus'])->name('keranjang.hapus');

        // CHECKOUT
        Route::get('/checkout', [ControllerCheckout::class, 'index'])->name('checkout.index');
        Route::post('/checkout/proses', [ControllerCheckout::class, 'proses'])->name('checkout.proses');

        // PESANAN
        Route::prefix('pesanan')->name('pesanan.')->group(function () {

            Route::get('/', [ControllerPesananPelanggan::class, 'index'])->name('index');
            Route::get('/{id}', [ControllerPesananPelanggan::class, 'detail'])->name('detail');

            Route::post('/bayar/kasir/{id}', [ControllerPesananPelanggan::class, 'bayarKasir'])->name('bayar.kasir');
            Route::post('/bayar/qris/{id}', [ControllerPesananPelanggan::class, 'bayarQris'])->name('bayar.qris');

            Route::get('/qris/{id}', [ControllerPesananPelanggan::class, 'qrisPage'])->name('qris.page');
            Route::post('/qris/konfirmasi/{id}', [ControllerPesananPelanggan::class, 'qrisKonfirmasi'])->name('qris.konfirmasi');
        });

        // WISHLIST
        Route::get('/wishlist', [ControllerWishlist::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist/tambah/{id}', [ControllerWishlist::class, 'tambah'])->name('wishlist.tambah');
        Route::delete('/wishlist/hapus/{id}', [ControllerWishlist::class, 'hapus'])->name('wishlist.hapus');

        // ULASAN (REVIEW PER INVOICE)
        Route::get('/ulasan', [ControllerUlasan::class, 'index'])->name('ulasan.index');
        Route::get('/ulasan/{penjualanid}/form', [ControllerUlasan::class, 'form'])->name('ulasan.form');
        Route::post('/ulasan/{penjualanid}/store', [ControllerUlasan::class, 'store'])->name('ulasan.store');
    });
