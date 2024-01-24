<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => ['role:user']], function () {
        Route::resource('/barangkeluar', BarangKeluarController::class);
    });
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('/barangmasuk', BarangMasukController::class);
        Route::post('/barangmasuk/export', [BarangMasukController::class, 'export'])->name('barangmasuk.export');
    });
});

Auth::routes();