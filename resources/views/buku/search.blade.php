<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Buku</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">

    <style>
        /* CSS for centering the table header */
        .text-center-header {
            text-align: center;
        }
        /* Custom styles for the table */
        .table-custom {
            background-color: #f8f9fa; /* Background color */
        }
        .table-custom th {
            background-color: #6f42c1; /* Header background color */
            color: white; /* Header text color */
        }
        .table-custom tbody tr:hover {
            background-color: #e9ecef; /* Row hover color */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Search form -->
        <form action="{{ route('buku.search') }}" method="get" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="kata" class="form-control" placeholder="Cari ..." required>
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <!-- Session Message -->
        @if(session('pesan'))
            <div class="alert alert-success">{{ session('pesan') }}</div>
        @endif

        <!-- Add Book Button -->
        <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>

        <!-- Header Title -->
        <h1 class="text-center-header mb-4">Hasil Pencarian Buku</h1>

        <!-- Table for Book Data -->
        <table id="myTable" class="table table-striped table-custom table-bordered">
            <thead>
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
                @if(count($data_buku) > 0)
                    @foreach ($data_buku as $index => $buku)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ "Rp. " . number_format($buku->harga, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin mau di hapus?')" type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                                        onclick="showDetail('{{ $buku->judul }}', '{{ $buku->penulis }}', '{{ $buku->harga }}', '{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}')">Detail</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada hasil ditemukan untuk kata kunci "{{ request()->kata }}"</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $data_buku->appends(request()->except('page'))->links() }}

        <!-- Total Books and Total Price -->
        @if(count($data_buku) > 0)
            <div class="alert alert-primary" role="alert">
                <p><strong>Jumlah Total Buku:</strong> {{ $total_buku }}</p>
                <p><strong>Jumlah Total Harga:</strong> {{ "Rp. " . number_format($total_harga, 0, ',', '.') }}</p>
            </div>
        @endif

        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Judul:</strong> <span id="modalJudul"></span></p>
                        <p><strong>Penulis:</strong> <span id="modalPenulis"></span></p>
                        <p><strong>Harga:</strong> <span id="modalHarga"></span></p>
                        <p><strong>Tanggal Terbit:</strong> <span id="modalTanggalTerbit"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

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
