<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS with Bootstrap 4 integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <style>
        /* CSS for centering the table header */
        .text-center-header {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Session Message -->
    @if(@Session::has('pesan'))
        <div class="alert alert-success">{{ Session::get('pesan') }}</div>
    @endif
    <div class="container mt-5">
        <!-- Add Book Button -->
        <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>

        <!-- Header Title -->
        <h1 class="text-center-header mb-4">Daftar Buku</h1>

        {{-- <form action="{{ route('buku.search') }}" method="get">
            @csrf
            <input type="text" name="kata" class="form-control" placeholder="Cari ..."
                   style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
        </form> --}}

        <!-- Table for Book Data -->
        <table id="myTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $index => $buku)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. ".number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau di hapus?')" type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal"
                                    onclick="showDetail('{{ $buku->judul }}', '{{ $buku->penulis }}', '{{ $buku->harga }}', '{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}')">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Books and Total Price -->
        <div class="alert alert-primary" role="alert">
            <p><strong>Jumlah Total Buku:</strong> {{ $total_buku }}</p>
            <p><strong>Jumlah Total Harga:</strong> {{ "Rp. ".number_format($total_harga, 0, ',', '.') }}</p>
        </div>
        <!-- Additional Book Count Display -->
        <div>
            <strong>Jumlah Buku: {{ $total_buku }}</strong>
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Judul:</strong> <span id="modalJudul"></span></p>
                        <p><strong>Penulis:</strong> <span id="modalPenulis"></span></p>
                        <p><strong>Harga:</strong> <span id="modalHarga"></span></p>
                        <p><strong>Tanggal Terbit:</strong> <span id="modalTanggalTerbit"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        // Function to show detail modal
        function showDetail(judul, penulis, harga, tanggal_terbit) {
            document.getElementById('modalJudul').innerText = judul;
            document.getElementById('modalPenulis').innerText = penulis;
            document.getElementById('modalHarga').innerText = "Rp. " + parseFloat(harga).toLocaleString('id-ID', {minimumFractionDigits: 2});
            document.getElementById('modalTanggalTerbit').innerText = tanggal_terbit;
        }

        // Initialize DataTables
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>