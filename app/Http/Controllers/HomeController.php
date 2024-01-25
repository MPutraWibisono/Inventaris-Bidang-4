<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $total = BarangMasuk::all();
        $barangtotal = $total->count();

        $start_date = now()->subDays(30);
        $end_date = now();
        $barang30hari = BarangMasuk::whereBetween('created_at', [$start_date, $end_date])->get();
        $total30hari = $barang30hari->count();

        return view('home', compact('total30hari'), compact('barangtotal'));
    }
}
