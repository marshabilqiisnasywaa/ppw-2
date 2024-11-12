@extends('layouts.app3')

@section('content')
<div class="container">
    <h4>Edit Buku</h4>
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


    <form method="POST" novalidate action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Method spoofing untuk PUT karena HTML forms tidak mendukung PUT secara langsung -->

        <!-- Input Judul Buku dengan value yang diambil dari variabel $buku -->
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" value="{{ $buku->judul }}" class="form-control" required>
        </div>

        <!-- Tambahkan input lain sesuai kebutuhan -->
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" value="{{ $buku->penulis }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" value="{{ $buku->harga }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
            <input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit->format('Y-m-d') }}" 
            class="form-control" required>

        </div>
            <label for="thumbnail" class="form-label">thumbnail</label>
            <input type="file" name="thumbnail" 
            class="form-control" required>
        </div>


         <!-- Display Existing Gallery Images -->
        <div class="gallery_items mt-4">
            <h5>Gallery</h5>
            @foreach($buku->galleries as $gallery)
                <div class="gallery_item mb-3">
                    <img
                        class="rounded object-cover object-center"
                        src="{{ asset($gallery->path) }}"
                        alt="{{ $gallery->nama_galeri }}"
                        width="150"
                    />
                </div>
            @endforeach
        </div>

        <!-- Dynamic Gallery File Upload -->
        <div id="galeri-section">
            <div class="mb-3">
                <label for="galeri[]" class="form-label">Galeri</label>
                <input type="file" name="galeri[]" class="form-control" required>
                <input type="file" name="galeri[]" class="form-control" required>
            </div>
        </div>
        

        <!-- Tombol untuk submit form -->
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
