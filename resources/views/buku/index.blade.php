@extends('auth.layouts')

@section('content')
<div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Buku</h1>
        @if(Auth::check() && Auth::user()->level == 'admin')
            <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>
        @endif
        
        <form action="{{ route('buku.search') }}" method="get">
            @csrf
            <input type="text" name="kata" class="form-control my-3 mx-3" placeholder="Cari ...." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float:right;">
        </form>

        <table id="myTable" class="table table-striped table-custom table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    @if(Auth::check() && Auth::user()->level == 'admin')
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. " . number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                        @if(Auth::check() && Auth::user()->level == 'admin')
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
                        @endif            
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="alert alert-primary" role="alert">
            <p><strong>Jumlah Total Buku:</strong> {{ $total_buku }}</p>
            <p><strong>Jumlah Total Harga:</strong> {{ "Rp. " . number_format($total_harga, 0, ',', '.') }}</p>
        </div>

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
@endsection