@extends('layouts.app3')

@section('content')
<div class="container mt-4">
    <h4>Tambah Buku</h4>
    <!-- Blade Template untuk menampilkan error -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('buku.store') }}" method="POST" novalidate>
        @csrf
        
        <!-- Input Judul Buku -->
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        
        <!-- Input Penulis -->
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" class="form-control" required>
        </div>

        <!-- Input Harga Buku -->
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <!-- Input Tanggal Terbit -->
        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
            <input type="text" id="tgl_terbit" name="tgl_terbit" class="date form-control" placeholder="yyyy/mm/dd">
        </div>

        <!-- Input Thumbnail -->
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control" required>
        </div>

        <!-- Dynamic Gallery File Upload -->
        <div id="galeri-section">
            <div class="mb-3">
                <label for="galeri[]" class="form-label">Galeri</label>
                <input type="file" name="galeri[]" class="form-control">
                <input type="file" name="galeri[]" class="form-control">
            </div>
        </div>

        <!-- Tombol Simpan dan Kembali -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
