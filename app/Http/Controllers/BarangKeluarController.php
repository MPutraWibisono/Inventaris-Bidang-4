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

    public function input ()
    {
        return view('barangkeluar.input');
    }

    public function store ()
    {
        $barang_keluar = BarangKeluar::input([
            'nama_barang' => $request->nama_barang,
            'harga'=> $request->harga,
            'stok'=> $request->stok,
            'tanggal_masuk'=> $request->tanggal_masuk,
        ]);
    }
}
