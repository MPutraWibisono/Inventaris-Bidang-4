<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $barangmasuk30hari = BarangMasuk::whereBetween('tanggal_masuk', [$start_date, $end_date])->get();
        $barangkeluar30hari = BarangKeluar::whereBetween('tanggal_keluar', [$start_date, $end_date])->get();
        $total30hari = $barangmasuk30hari->count() + $barangkeluar30hari->count();

        $tahunSekarang = date('Y');

        $barangmasuktiapbulan = BarangMasuk::select(DB::raw('MONTHNAME(tanggal_masuk) as month, COUNT(*) as count'))
            ->whereYear('tanggal_masuk', $tahunSekarang)
            ->groupBy(DB::raw('MONTHNAME(tanggal_masuk)'))
            ->orderByRaw('MONTH(tanggal_masuk)')
            ->get();

        $barangmasuktiapbulancount = [];

        foreach ($barangmasuktiapbulan as $hitungbarang) {
            $barangmasuktiapbulancount[$hitungbarang->month] = $hitungbarang->count;
        }

        return view('home', [
            'barangmasuktiapbulan' => $barangmasuktiapbulancount,
            'barangmasuk' => $barangmasuk,
            'barangkeluar' => $barangkeluar,
            'daftaruser' => $daftaruser,
            'total30hari' => $total30hari,
            'barangmasuktotal' => $barangmasuktotal,
            'barangkeluartotal' => $barangkeluartotal,
            'totalbarangmasukkeluar' => $totalbarangmasukkeluar
        ]);
    }

}
