<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\Controller;
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
        return redirect('/dashboard');
    });
    Route::get('/dashboard',[DashboardController::class, 'index']);
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
    //supplier
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::post('/supplier/create', [SupplierController::class, 'create']);
    Route::get('/supplier/{id_supplier}/edit', [SupplierController::class, 'edit']);
    Route::post('/supplier/{id_supplier}/update', [SupplierController::class, 'update']);
    Route::get('/supplier/{id_supplier}/delete', [SupplierController::class, 'delete']);
    
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/user', [UserController::class, 'index']);
        Route::post('/user/create', [UserController::class, 'create']);
        Route::get('/user/{id_user}/edit', [UserController::class, 'edit']);
        Route::post('/user/{id_user}/update', [UserController::class, 'update']);
        Route::get('/user/{id_user}/delete', [USerController::class, 'delete']);
    });
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index']);
        // Route::get('/laporankategori', [LaporanController::class, 'laporankategori']);
    });
    Route::middleware(['role:pengguna,admin'])->group(function () {
        Route::get('/barangkeluar', [BarangkeluarController::class, 'index']);
        Route::post('/barangkeluar/create', [BarangkeluarController::class, 'create']);
        Route::get('/barangkeluar/{kode_barang_keluar}/edit', [BarangkeluarController::class, 'edit']);
        Route::post('/barangkeluar/{kode_barang_keluar}/update', [BarangkeluarController::class, 'update']);
        Route::get('/barangkeluar/{kode_barang_keluar}/delete', [BarangkeluarController::class, 'delete']);
        
    });
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
Route::post('webservice/login', [service::class, 'user']);
Route::post('webservice/tambah-barang', [service::class, 'tambahBarang']);
Route::post('webservice/tambah-jenis', [service::class, 'tambahJenis']);
Route::get("webservice/hapusBarang", [service::class, "hapusBarang"]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//test route
Route::get('/testing', [CobaController::class, 'index']);

// route cetak barcode all
Route::get('/barang/qr-batch', [BarangController::class, 'cetakBatch']);


// // Laporan based jenis
// Route::get('/laporan-based-jenis', [LaporanController::class, 'laporanbasedjenis']);
// Route::get('/laporan-based-jenis-value', [LaporanController::class, 'laporanbasedjenisvalue']);
