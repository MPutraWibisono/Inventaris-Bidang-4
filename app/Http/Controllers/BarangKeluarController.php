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
        $barang_masuk = BarangMasuk::all(); 
        $barang_keluar = BarangKeluar::with('barangmasuk')->get();
        return view('barangkeluar.index', ['barangkeluar' => $barang_keluar, 'barangmasuk' => $barang_masuk]);
    }

    public function create()
    {
        $barang_masuk = BarangMasuk::all(); 
        return view('barangkeluar.create', ['barangmasuk' => $barang_masuk]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengambil' => ['required', 'max:255'],
            'barang_id' => ['required'],
            'jumlah_ambil' => ['required', 'numeric'],
            'tanggal_keluar' => ['required', 'date'],
        ]);

        $id_barang_masuk = BarangMasuk::find($request->barang_id);

        if ($id_barang_masuk) {
            $stok_barang = $id_barang_masuk->stok;

            // Validate if there's enough stock to perform the withdrawal
            if ($stok_barang >= $request->jumlah_ambil) {
                $stok_updated = $stok_barang - $request->jumlah_ambil;

                $id_barang_masuk->update([
                    'stok' => $stok_updated,
                ]);

                $barang_keluar = BarangKeluar::create([
                    'nama_pengambil' => $request->nama_pengambil,
                    'barang_id' => $request->barang_id,
                    'jumlah_ambil' => $request->jumlah_ambil,
                    'tanggal_keluar' => $request->tanggal_keluar,
                ]);

                return redirect()->route('barangkeluar.index');
            } else {
                // Handle the case where there's not enough stock
                return back()->withErrors(['jumlah_ambil' => 'Not enough stock available.']);
            }
        } else {
            // Handle the case where the specified "barang_id" is not found
            return back()->withErrors(['barang_id' => 'Invalid barang_id.']);
        }

        $barang_keluar = BarangKeluar::create([
            'nama_pengambil' => $request->nama_pengambil,
            'barang_id' => $request->barang_id,
            'jumlah_ambil' => $request->jumlah_ambil,
            'tanggal_keluar' => $request->tanggal_keluar,
        ]);

        return redirect()->route('barangkeluar.index');
    }
}
