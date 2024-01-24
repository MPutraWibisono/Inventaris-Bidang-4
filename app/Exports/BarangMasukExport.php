<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class BarangMasukExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public $tanggal_masuk, $barang_masuk;

    public function __construct($tanggal_masuk, $barang_masuk)
    {
        $this->tanggal_masuk = $tanggal_masuk;
        $this->barang_masuk = $barang_masuk;
    }

    public function view(): View
    {
        $barang_masuk = BarangMasuk::all();
        return view('barangmasuk.export', ['barangmasuk' => $this->barang_masuk, 'tanggal_masuk' => $this->tanggal_masuk]);
    }

}
