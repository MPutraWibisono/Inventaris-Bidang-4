<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    public function getWarna($index){
        $warna = ['primary', 'success', 'info'];
        return $warna[$index % count($warna)];
    }

    public function index()
    {
        $barangmasuk = BarangMasuk::all();
        $barangmasuktotal = $barangmasuk->count();

        $barangkeluar = BarangKeluar::all();
        $barangkeluartotal = $barangkeluar->count();

        $totalbarangmasukkeluar = $barangmasuktotal + $barangkeluartotal;

        $daftaruser = User::all();

        $start_date = now()->subDays(30);
        $end_date = now();
        $barangmasuk30hari = BarangMasuk::whereBetween('created_at', [$start_date, $end_date])->get();
        $barangkeluar30hari = BarangKeluar::whereBetween('tanggal_keluar', [$start_date, $end_date])->get();
        $total30hari = $barangmasuk30hari->count() + $barangkeluar30hari->count();

        return view('home', compact('total30hari', 'barangmasuktotal', 'barangkeluartotal', 'totalbarangmasukkeluar'), ['barangmasuk' => $barangmasuk, 'barangkeluar' => $barangkeluar, 'daftaruser' => $daftaruser]);
    }

}
