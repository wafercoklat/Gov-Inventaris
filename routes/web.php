<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DBController;
use App\Http\Controllers\DRController;
use App\Http\Controllers\DLController;
use App\Http\Controllers\DKController;
use App\Http\Controllers\BarangRusak;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DKondisiController;
use App\Http\Controllers\DTrans_Controller;
use App\Http\Controllers\UserController;
use App\Model\Barang;

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
 
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/Trans', DTrans_Controller::class);
    Route::resource('/Barang', DBController::class);
    Route::resource('/Lantai', DLController::class);
    Route::resource('/Ruangan', DRController::class);
    Route::resource('/Kondisi', DKController::class);
    Route::resource('/Daftar-Barang-Rusak', BarangRusak::class);
    Route::get('/Pindah', [DTrans_Controller::class, 'pindah'])->name('pindah');
    Route::post('/PindahBarang/Approve/{detailID}/{IdBarang}/{IdRuangan}/{IdTrans}', [DTrans_Controller::class,'updateDate'])->name('Approve');
    Route::post('/PindahBarang/Check/{detailID}/{IdBarang}/{IdRuangan}/{IdTrans}', [DTrans_Controller::class,'Checked'])->name('Check');
   
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/Error', [HomeController::class, 'error'])->name('error'); 
    Route::get('/TambahBarang/Scan', [DBController::class, 'scan'])->name('Scan');
    Route::post('/ScanStore', [DBController::class, 'storeBR'])->name('AddScan');    
    Route::get('/ScanTrans', [DTrans_Controller::class, 'scanTrans'])->name('TransScan');
    Route::get('/Scan-LaporBarang', [DKController::class, 'scanTrans'])->name('LaporScan');
    Route::post('/Kondisi/Diperbaiki/{detailID}/{IdTrans}/{flag}/{IdBarang}', [DKController::class,'updateDate'])->name('Selesai');
    Route::post('/Kondisi/RusakBerat/{detailID}/{IdTrans}/{flag}/{IdBarang}', [DKController::class,'updateDate'])->name('RusakBerat');
    Route::get('/PrintLapor/{var}', [DKController::class,'print'])->name('PrintLaporan');
    Route::get('/PrintPindah/{var}', [DTrans_Controller::class,'print'])->name('PrintPindah');
    Route::resource('/Dashboard', Dashboard::class);
    Route::get('/myProfile',[UserController::class, 'profile'])->name('Userprofile');
    
    Route::group(['middleware' => 'checkRole:admin'], function(){
        Route::resource('/User', UserController::class);
        Route::get('/User/{var}/nonActive', [UserController::class, 'NActive'])->name('NActive');
        Route::get('/User/{var}/Active', [UserController::class, 'Active'])->name('Active');
    });

});