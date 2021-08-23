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
use App\Http\Controllers\DKondisiController;
use App\Http\Controllers\DTrans_Controller;
use App\Model\Barang;

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
 
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/Trans', DTrans_Controller::class);
    Route::group(['middleware' => 'checkRole:admin,operator'], function(){
        Route::resource('/Barang', DBController::class);
        Route::resource('/Lantai', DLController::class);
        Route::resource('/Ruangan', DRController::class);
        Route::resource('/Lapor', DKController::class);
        Route::get('/Kondisi/{var}', [DBController::class, 'kondisi'])->name('Kondisi');
        Route::get('/Trans/Update/{var}', [DTrans_Controller::class, 'create'])->name('Update');
    });
    Route::group(['middleware' => 'checkRole:umum'], function(){
        Route::get('/Barang#', [DBController::class, 'index'])->name('Barang#');
        Route::get('/Ruangan#', [DBController::class, 'index'])->name('Ruangan#');
        Route::get('/Lantai#', [DBController::class, 'index'])->name('Lantai#');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
 
});