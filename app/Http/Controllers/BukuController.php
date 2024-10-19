<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index() {
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $jumlah_buku = Buku::count();
        $no = $batas * ($data_buku->currentPage() - 1);
        $total_harga = $data_buku->sum('harga');

        return view('buku.index', compact('data_buku', 'no', 'jumlah_buku', 'total_harga'));
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

    public function search(Request $request) {
        $batas = 5;
        $cari = $request->input('kata');

        // Perform the search using the search term
        $data_buku = Buku::where('judul', 'like', "%{$cari}%")
                        ->orWhere('penulis', 'like', "%{$cari}%")
                        ->paginate($batas);

        $jumlah_buku = $data_buku->total();
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.search', compact('jumlah_buku', 'data_buku', 'no', 'cari'));
    }
}
    
    
    

