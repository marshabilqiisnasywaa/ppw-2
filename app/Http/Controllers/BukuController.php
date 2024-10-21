<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    // Fungsi untuk menampilkan daftar buku
    public function index()
    {
        $batas = 5;  // Pagination limit
        $data_buku = Buku::paginate($batas);
        $jumlah_buku = Buku::count();
        $total_harga = Buku::sum('harga');
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga', 'no'));
    }

    public function create() {
        return view('buku.create');
    }

    public function store(Request $request) {
        // Validasi data input
        $this->validate($request, [
            'judul'      => 'required|string|max:255',
            'penulis'    => 'required|string|max:30',
            'harga'      => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ], [
            'judul.required'      => 'Judul buku wajib diisi.',
            'judul.max'           => 'Judul buku maksimal 255 karakter.',
            'penulis.required'    => 'Nama penulis wajib diisi.',
            'penulis.max'         => 'Nama penulis maksimal 30 karakter.',
            'harga.required'      => 'Harga buku wajib diisi.',
            'harga.numeric'       => 'Harga buku harus berupa angka.',
            'tgl_terbit.required' => 'Tanggal terbit wajib diisi.',
            'tgl_terbit.date'     => 'Format tanggal terbit tidak valid.'
        ]);

        // Simpan data buku
        Buku::create($request->all());

        // Redirect dengan pesan sukses
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil disimpan!');
    }

    public function destroy($id) {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil dihapus!');
    }

    public function show($id) {
        $buku = Buku::findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    public function edit($id) {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id) {
        $buku = Buku::findOrFail($id);

        // Validasi input
        $this->validate($request, [
            'judul'      => 'required|string|max:255',
            'penulis'    => 'required|string|max:255',
            'harga'      => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ], [
            'judul.required'      => 'Judul buku wajib diisi.',
            'judul.max'           => 'Judul buku maksimal 255 karakter.',
            'penulis.required'    => 'Nama penulis wajib diisi.',
            'penulis.max'         => 'Nama penulis maksimal 255 karakter.',
            'harga.required'      => 'Harga buku wajib diisi.',
            'harga.numeric'       => 'Harga buku harus berupa angka.',
            'tgl_terbit.required' => 'Tanggal terbit wajib diisi.',
            'tgl_terbit.date'     => 'Format tanggal terbit tidak valid.'
        ]);

        // Update data buku
        $buku->update($request->all());

        // Redirect dengan pesan sukses
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil diperbarui!');
    }

    // BukuController.php
    public function search(Request $request)
{
    $batas = 5;  // Batasi jumlah data per halaman
    $cari = $request->kata;  // Ambil input pencarian dari form
    
    // Query pencarian, cari berdasarkan judul atau penulis
    $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")
        ->orWhere('penulis', 'like', "%" . $cari . "%")
        ->paginate($batas);

    // Hitung jumlah hasil pencarian
    $jumlah_buku = $data_buku->total();
    $no = $batas * ($data_buku->currentPage() - 1);

    // Return ke view search.blade.php dengan data hasil pencarian
    return view('buku.search', compact('data_buku', 'jumlah_buku', 'no', 'cari'));
}

}
    
    
    

