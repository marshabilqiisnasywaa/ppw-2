<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Pesan sukses -->
    @if(session('pesan'))
        <div class="alert alert-success">
            {{ session('pesan') }}
        </div>
    @endif
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h1>Daftar Buku</h1>

            <!-- Tombol Tambah Buku -->
            <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
        </div>

        <!-- Form Search -->
        <form action="{{ route('buku.search') }}" method="GET" class="mb-4">
            <input type="text" name="kata" placeholder="Cari buku..." value="{{ request()->get('kata') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <!-- Tabel Daftar Buku -->
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    <th colspan="3" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $index => $buku)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ number_format($buku->harga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>

                    <!-- Tombol Aksi -->
                    <td>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-info">Lihat Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>

        <!-- Jumlah Buku dan Total Harga -->
        <div class="mt-3">
            <p><strong>Jumlah Buku: </strong> {{ $jumlah_buku }}</p>
            <p><strong>Total Harga Buku: </strong> {{ "Rp. " . number_format($total_harga, 2, ',', '.') }}</p>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
