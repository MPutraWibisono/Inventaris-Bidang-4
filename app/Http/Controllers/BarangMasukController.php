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

    public function input ()
    {
        return view('barangkeluar.input');
    }

    public function store (Request $request)
    {
        $barang_masuk = BarangMasuk::input([
            'nama_barang' => $request->nama_barang,
            'harga'=> $request->harga,
            'stok'=> $request->stok,
            'tanggal_masuk'=> $request->tanggal_masuk,
        ]);
    }
}
