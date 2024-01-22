<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('barangkeluar.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pengambil" class="form-label">Nama</label>
                        <input type="text" name="nama_pengambil" class="form-control @error('nama_pengambil') is-invalid @enderror" id="nama_pengambil"
                        placeholder="Masukkan Nama Anda">
                        @error('nama_pengambil')
                        <p class="form-text" style="color: red;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Nama Barang</label>
                        <select class="form-select" name="barang_id" aria-label="Default Select Example">
                            <option selected>Pilih Barang</option>
                            @foreach ($barangmasuk as $barang)
                            <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_ambil" class="form-label">Jumlah Ambil</label>
                        <input type="number" name="jumlah_ambil" class="form-control @error('jumlah_ambil') is-invalid @enderror" id="jumlah_ambil"
                        placeholder="Masukkan Jumlah Barang yang Diambil">
                        @error('jumlah_ambil')
                        <p class="form-text" style="color: red;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_keluar" class="form-label">Tanggal Barang Keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar"
                        placeholder="Masukkan Tanggal diambilnya Barang">
                        @error('tanggal_keluar')
                        <p class="form-text" style="color: red;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Save" class="btn btn-primary" id="button"
                        placeholder="Save">
                        <a href="{{ route('barangkeluar.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>