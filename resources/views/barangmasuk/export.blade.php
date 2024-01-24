<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Tanggal Masuk</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($barangmasuk as $barang)
        <tr>
            <td>{{ $barang->nama_barang }}</td>
            <td>{{ $barang->harga }}</td>
            <td>{{ $barang->stok }}</td>
            <td>{{ $barang->tanggal_masuk }}</td>
        </tr>
        @endforeach
    </tbody>
</table>