<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tes', [MainController::class,'tes']);
Route::get('/tes1', [AdminController::class,'tes']);
Route::get('/main', [MainController::class,'index']);
Route::get('/dashboard', [MainController::class,'dashboardDetail']);
Route::get('/login', [LoginController::class,'login']);
Route::post('/login', [LoginController::class,'loginUser']);
Route::group(['prefix'=>'/admin','middleware'=> ['adminmid']],function () {
    Route::get('/home',  [AdminController::class,'index']);
    Route::get('/kecamatan',  [AdminController::class,'menuKecamatan']);
    Route::get('/desa',  [AdminController::class,'menuDesa']);
    Route::post('/updatekecamatan',  [AdminController::class,'editKecamatan']);
    Route::post('/hapuskecamatan',  [AdminController::class,'hapusKecamatan']);
    Route::post('/updatedesa',  [AdminController::class,'editDesa']);
    Route::post('/createkecamatan',  [AdminController::class,'createKecamatan']);
    Route::post('/createdesa',  [AdminController::class,'createDesa']);
    Route::post('/hapusdesa',  [AdminController::class,'hapusDesa']);
    Route::get('/settingmap',  [AdminController::class,'showMapConfig']);
    Route::post('/savesettingmap',  [AdminController::class,'saveMapConfig']);
    Route::post('/detailkecamatan',  [MainController::class,'detilKecamatan']);
    Route::post('/getdatakemiskikanbydesa',  [MainController::class,'getDataKemiskinanByDesa']);
    Route::get('/datakemiskinan',  [AdminController::class,'dataKemiskinan']);
    Route::post('/listdatakemiskinan',  [AdminController::class,'getDataKemiskinan']);
    Route::get('/opd',  [AdminController::class,'showListOpd']);
});
