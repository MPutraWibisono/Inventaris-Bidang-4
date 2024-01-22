<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\BarangMasuk;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = BarangMasuk::all();
        return view('barangmasuk.index', ['barangmasuk' => $barang_masuk]);
    }
}
