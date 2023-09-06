<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PerawatControlller;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DokterController;
use App\Models\Riwayat;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard');

// Dashboard

Route::get('/dashboard', function () {
    return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
});

// credits
Route::get('/credits', function () {
    return view('pages.credits', ['type_menu' => '']);
});

//pasien
Route::get('/data-pasien', [PasienController::class, 'index'])->name('pasien.index');
Route::get('/tambah-pasien', [PasienController::class, 'tambah'])->name('pasien.tambah');
Route::post('/store-pasien',  [PasienController::class, 'store'])->name('pasien.store');
Route::get('/add-pasien', [PasienController::class, 'add'])->name('pasien.add');
Route::post('/save-pasien',  [PasienController::class, 'save'])->name('pasien.save');

Route::get('/edit-pasien/{id}',  [PasienController::class, 'edit'])->name('pasien.edit');
Route::get('/ubah-pasien/{id}',  [PasienController::class, 'ubah'])->name('pasien.ubah');
Route::get('/desc-pasien/{id}',  [PasienController::class, 'desc'])->name('pasien.desc');
Route::get('/deks-pasien/{id}',  [PasienController::class, 'deks'])->name('pasien.deks');
Route::post('/update-pasien',  [PasienController::class, 'update'])->name('pasien.update');
Route::post('/put-pasien',  [PasienController::class, 'put'])->name('pasien.put');
Route::get('/hapus-pasien/{id}',  [PasienController::class, 'hapus'])->name('pasien.hapus');

//perawat
Route::get('/data-perawat', [PerawatControlller::class, 'index'])->name('perawat.index');
Route::get('/tambah-perawat', [PerawatControlller::class, 'tambah'])->name('perawat.tambah');
Route::post('/store-perawat',  [PerawatControlller::class, 'store'])->name('perawat.store');
Route::get('/edit-perawat/{id}',  [PerawatControlller::class, 'edit'])->name('perawat.edit');
Route::post('/update-perawat',  [PerawatControlller::class, 'update'])->name('perawat.update');
Route::get('/hapus-perawat/{id}',  [PerawatControlller::class, 'hapus'])->name('perawat.hapus');

//riwayat
Route::get('/data-riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
Route::get('/tambah-riwayat', [RiwayatController::class, 'tambah'])->name('riwayat.tambah');
Route::post('/store-riwayat',  [RiwayatController::class, 'store'])->name('riwayat.store');
Route::get('/desc-riwayat/{id}',  [RiwayatController::class, 'desc'])->name('riwayat.desc');
Route::get('/edit-riwayat/{id}',  [RiwayatController::class, 'edit'])->name('riwayat.edit');
Route::get('/hapus-riwayat/{id}',  [RiwayatController::class, 'hapus'])->name('riwayat.hapus');

//dokter
Route::get('/data-dokter', [DokterController::class, 'index'])->name('dokter.index');
Route::get('/tambah-dokter', [DokterController::class, 'tambah'])->name('dokter.tambah');
Route::post('/store-dokter',  [DokterController::class, 'store'])->name('dokter.store');
Route::get('/edit-dokter/{id}',  [DokterController::class, 'edit'])->name('dokter.edit');
Route::post('/update-dokter',  [DokterController::class, 'update'])->name('dokter.update');
Route::get('/hapus-dokter/{id}',  [DokterController::class, 'hapus'])->name('dokter.hapus');



