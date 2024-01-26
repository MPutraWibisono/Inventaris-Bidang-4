<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
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

    public function create ()
    {
        $barang_masuk = BarangMasuk::all();
        return view('barangkeluar.create', ['barangmasuk' => $barang_masuk]);
    }

    public function store (Request $request)
    {
        $barang_masuk = BarangMasuk::pluck('nama_barang')->toarray();
        $request->validate([
            'nama_pengambil' => ['required', 'max:255'],
            'barang_id' => ['required'],
            'jumlah_ambil' => ['required', 'numeric'],
            'tanggal_keluar' => ['required', 'date'],
        ]);

        $barang_keluar = BarangKeluar::create([
            'nama_pengambil' => $request->nama_pengambil,
            'barang_id'=> $request->barang_id,
            'jumlah_ambil'=> $request->jumlah_ambil,
            'tanggal_keluar'=> $request->tanggal_keluar,
        ]);
        return redirect()->route('barangkeluar.index');
    }
}
