<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\BarangKeluar;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barang_keluar = BarangKeluar::all();
        return view('barangkeluar.index', ['barangkeluar' => $barang_keluar]);
    }
}
