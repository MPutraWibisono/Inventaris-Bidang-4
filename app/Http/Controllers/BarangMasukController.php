<?php

namespace App\Http\Controllers;

use App\Exports\BarangMasukExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\BarangMasuk;
use Maatwebsite\Excel\Facades\Excel;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = BarangMasuk::all();
        return view('barangmasuk.index', ['barangmasuk' => $barang_masuk]);
    }

    public function show($id)
    {

    }

    public function create ()
    {
        return view('barangmasuk.create');
    }

    public function store (Request $request)
    {   
        if(($request->stok) == 0){
            return back()->withErrors(['stok' => 'Stok tidak bisa kosong']);
        }

        $request->validate([
            'nama_barang' => ['required', 'max:255'],
            'harga' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'tanggal_masuk' => ['required', 'date'],
        ]);

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
        if(($request->stok) == 0){
            return back()->withErrors(['stok' => 'Stok tidak bisa kosong']);
        }

        $barang_masuk = BarangMasuk::find($id);

        $request->validate([
            'nama_barang' => ['required', 'max:255'],
            'harga' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'tanggal_masuk' => ['required', 'date'],
        ]);

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

    public function export(Request $request)
    {
        $tanggal_masuk = $request->tanggal_masuk;
        if(isset($tanggal_masuk)){
            $barang_export = BarangMasuk::where('tanggal_masuk', $tanggal_masuk)->get();
            return Excel::download(new BarangMasukExport($tanggal_masuk, $barang_export),'Data-Barang-Masuk.xlsx');
        } else{
            $barang_export = BarangMasuk::all();
            return Excel::download(new BarangMasukExport($tanggal_masuk, $barang_export),'Data-Barang-Masuk.xlsx');
        }
    }
}
