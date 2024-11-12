@extends('layouts.app3')

@section('content')
<div class="container mt-4">
    <h4>Detail Buku</h4>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Judul: {{ $buku->judul }}</h5>

            @if ($buku->filepath)
                <div class="mb-3">
                    <img
                        class="rounded img-fluid"
                        src="{{ asset($buku->filepath) }}"
                        alt="{{ $buku->judul }}"
                        style="max-width: 150px;"
                    />
                </div>
            @endif

            <p class="card-text"><strong>Penulis:</strong> {{ $buku->penulis }}</p>
            <p class="card-text"><strong>Harga:</strong> Rp. {{ number_format($buku->harga, 2, 
            ',', '.') }}</p>
            <p class="card-text"><strong>Tanggal Terbit:</strong> {{ $buku->tgl_terbit->format('d/m/Y') }}</p>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <a href="{{ route('buku.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
