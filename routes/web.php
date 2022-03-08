<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\service;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        // return view('welcome');
        return redirect('/barang');
    });
    Route::get('/barang',[BarangController::class, 'index']);
    Route::post('/barang/create', [BarangController::class, 'create']);
    Route::get('/barang/{kode_barang}/edit', [BarangController::class, 'edit']);
    Route::post('/barang/{kode_barang}/update', [BarangController::class, 'update']);
    Route::get('/barang/{kode_barang}/delete', [BarangController::class, 'delete']);
    Route::get('/barang/{kode_barang}/cetak', [BarangController::class, 'cetak']);
    Route::get('/jenis', [JenisController::class, 'index']);
    Route::post('/jenis/create', [JenisController::class, 'create']);
    Route::get('/jenis/{id_jenis_barang}/edit', [JenisController::class, 'edit']);
    Route::post('/jenis/{id_jenis_barang}/update', [JenisController::class, 'update']);
    Route::get('/jenis/{id_jenis_barang}/delete', [JenisController::class, 'delete']);
    Route::get('/stok', [StokController::class, 'index']);
    Route::post('/stok/create', [StokController::class, 'create']);
    Route::get('/stok/{kodeStok}/edit', [StokController::class, 'edit']);
    Route::post('/stok/{kodeStok}/update', [StokController::class, 'update']);
    Route::get('/stok/{kodeStok}/delete', [StokController::class, 'delete']);
    
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::get('/user', [UserController::class, 'index']);
        Route::post('/user/create', [UserController::class, 'create']);
        Route::get('/user/{id_user}/edit', [UserController::class, 'edit']);
        Route::post('/user/{id_user}/update', [UserController::class, 'update']);
        Route::get('/user/{id_user}/delete', [USerController::class, 'delete']);
    });

    Route::get('/laporan', [LaporanController::class, 'index']);
});

// Auth::routes();
Auth::routes([
    'verification' => false,
    'reset_password' => false,
    'forgot_password' => false,
    'login' => true,
    'register' => false,
]);
Route::get('webservice/listbarang', [service::class, 'index']);
Route::get('webservice/liststok', [service::class, 'lihat']);
Route::get('webservice/listjenis', [service::class, 'lihatjenis']);
Route::get("webservice/detailbarang", [service::class, "detailBarang"]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//test route
Route::get('/testing', [CobaController::class, 'index']);