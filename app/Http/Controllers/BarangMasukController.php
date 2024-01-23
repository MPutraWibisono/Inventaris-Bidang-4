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

    public function create ()
    {
        return view('barangmasuk.create');
    }

    public function store (Request $request)
    {
        $barang_masuk = BarangMasuk::create([
            'nama_barang' => $request->nama_barang,
            'harga'=> $request->harga,
            'stok'=> $request->stok,
            'tanggal_masuk'=> $request->tanggal_masuk,
        ]);
        return redirect()->route('barangmasuk.index');
    }

    public function edit($id){
        $barang_masuk = BarangMasuk::find($id);
        return view('barangmasuk.edit', ['barangmasuk'=> $barang_masuk]);
    }

    public function update(Request $request, $id){
        $barang_masuk = BarangMasuk::find($id);
        $barang_masuk->update([
            'nama_barang' => $request->nama_barang,
            'harga'=> $request->harga,
            'stok'=> $request->stok,
            'tanggal_masuk'=> $request->tanggal_masuk,
        ]);
        return redirect()->route('barangmasuk.index');
    }

    public function destroy ($id)
    {
        $barang_masuk = BarangMasuk::find($id);
        $barang_masuk->delete();
        return redirect()->route('barangmasuk.index')->with('success');
    }
}
