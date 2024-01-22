<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;

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

Route::get('/barangkeluar', [BarangKeluarController::class,'index'])->name('barangkeluar.index');

Route::get('/barangmasuk', [BarangMasukController::class,'index'])->name('barangmasuk.index');
Route::get('/barangmasuk/input', [BarangMasukController::class,'input'])->name('barangmasuk.input');
Route::get('/barangmasuk/store', [BarangMasukController::class,'store'])->name('barangmasuk.store');

Auth::routes();