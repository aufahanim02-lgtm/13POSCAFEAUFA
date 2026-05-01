<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Landing\ControllerLanding;

use App\Http\Controllers\Auth\ControllerAuthUser;
use App\Http\Controllers\Auth\ControllerAuthLoginHistory;

use App\Http\Controllers\Dashboard\ControllerDashboardOwner;
use App\Http\Controllers\Dashboard\ControllerDashboardManager;
use App\Http\Controllers\Dashboard\ControllerDashboardKasir;

/*
|--------------------------------------------------------------------------
| ROUTE LANDING (GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/', [ControllerLanding::class, 'home'])->name('landing.home');
Route::get('/menu', [ControllerLanding::class, 'menu'])->name('landing.menu');
Route::get('/promo', [ControllerLanding::class, 'promo'])->name('landing.promo');
Route::get('/tentang', [ControllerLanding::class, 'tentang'])->name('landing.tentang');
Route::get('/kontak', [ControllerLanding::class, 'kontak'])->name('landing.kontak');

/*
|--------------------------------------------------------------------------
| ROUTE AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [ControllerAuthUser::class, 'login'])->name('auth.login');
Route::post('/login', [ControllerAuthUser::class, 'loginProses'])->name('auth.loginproses');
Route::get('/logout', [ControllerAuthUser::class, 'logout'])->name('auth.logout');

/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD OWNER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:owner'])->group(function () {

    Route::get('/dashboardowner', [ControllerDashboardOwner::class, 'index'])
        ->name('dashboard.owner');

    Route::get('/loginhistory', [ControllerAuthLoginHistory::class, 'index'])
        ->name('loginhistory.index');

});

/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD MANAGER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:manager'])->group(function () {

    Route::get('/dashboardmanager', [ControllerDashboardManager::class, 'index'])
        ->name('dashboard.manager');

});

/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD KASIR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/dashboardkasir', [ControllerDashboardKasir::class, 'index'])
        ->name('dashboard.kasir');

});