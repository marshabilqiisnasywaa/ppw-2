@extends('layouts.app3')

@section('content')
    @if($jumlah_buku > 0)
        <div class="alert alert-success">
            Ditemukan <strong>{{ $jumlah_buku }}</strong> data dengan kata: <strong>{{ $cari }}</strong>
        </div>
    @else
        <div class="alert alert-warning">
            <h4>Data "{{ $cari }}" tidak ditemukan</h4>
            <a href="{{ route('buku.index') }}" class="btn btn-warning">Kembali</a>
        </div>
    @endif

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
                <td>{{ $no + $index + 1 }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ number_format($buku->harga, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                <td><a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a></td>
                <td>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
                <td><a href="{{ route('buku.show', $buku->id) }}" class="btn btn-info">Lihat Detail</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center">
        <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>
        <p class="mb-0"><strong>Jumlah Buku: </strong> {{ $jumlah_buku }}</p>
    </div>
@endsection

@section('scripts')
<script>
    // Any additional scripts specific to this page can be included here.
</script>
@endsection
