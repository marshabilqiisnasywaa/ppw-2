<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Intervention\Image\Facades\Image;
Paginator::useBootstrapFive();

class BukuController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function indexdatatable()
    {

        Paginator::useBootstrapFive();
        $data_buku = Buku::orderBy('id', 'desc')->get(); // Ambil semua data buku yang sudah diurutkan
        $total_buku = $data_buku->count(); // Menghitung jumlah total buku
        $total_harga = $data_buku->sum('harga'); // Menghitung jumlah total harga buku
        return view('buku.indexdatatable', compact('data_buku', 'total_buku', 'total_harga'));

    }


    //N0 3 tugas praktikum
    public function index(){
        $batas = 10;
        $total_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);

        $total_harga = Buku::sum('harga');
        return view('buku.index', compact('data_buku', 'no', 'total_buku', 'total_harga'));
    }


    public function search(Request $request) {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")
                         ->orWhere('penulis', 'like', "%" . $cari . "%")
                         ->paginate($batas);

        $total_harga = 0;
        foreach($data_buku as $buku){
            $total_harga+=$buku->harga;
        }

        $total_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        // dd($data_buku);

        return view('buku.search', compact('total_buku', 'data_buku', 'no', 'cari', 'total_harga'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'judul' => 'required|string',
        'penulis' => 'required|string|max:30',
        'harga' => 'required|numeric',
        'tgl_terbit' => 'required|date'
    ], [
        'judul.required' => 'Kolom Judul Buku wajib diisi.',
        'penulis.required' => 'Kolom Nama Penulis wajib diisi.',
        'penulis.max' => 'Kolom Nama Penulis tidak boleh lebih dari 30 karakter.',
        'harga.required' => 'Kolom Harga Buku wajib diisi.',
        'harga.numeric' => 'Kolom Harga Buku harus berupa angka.',
        'tgl_terbit.required' => 'Kolom Tanggal Terbit wajib diisi.',
        'tgl_terbit.date' => 'Kolom Tanggal Terbit tidak valid.'
    ]);

    $buku = new Buku();
    $buku->judul = $request->judul;
    $buku->penulis = $request->penulis;
    $buku->harga = $request->harga;
    $buku->tgl_terbit = $request->tgl_terbit;
    $buku->save();


    // Handle gallery uploads
    if ($request->file('gallery')) {
        foreach ($request->file('gallery') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            Gallery::create([
                'nama_galeri' => $fileName,
                'path' => '/storage/' . $filePath,
                'foto' => $fileName,
                'buku_id' => $buku->id // Use the ID of the newly created Buku
            ]);
        }
    }

    return redirect('/buku')->with('pesan', 'Data Buku Berhasil disimpan');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil data buku berdasarkan ID
        $buku = Buku::findOrFail($id);
        
        // Pastikan view 'buku.show' ada dan data buku ditampilkan
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        $buku = Buku::find($id);

        $validatedData = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail'=> 'image|mimes:jpeg,jpg,png|max:20000'
        ], [
            'judul.required' => 'Kolom Judul Buku wajib diisi.',
            'penulis.required' => 'Kolom Nama Penulis wajib diisi.',
            'harga.required' => 'Kolom Harga Buku wajib diisi.',
            'harga.numeric' => 'Kolom Harga Buku harus berupa angka.',
            'tgl_terbit.required' => 'Kolom Tanggal Terbit wajib diisi.',
            'tgl_terbit.date' => 'Kolom Tanggal Terbit tidak valid.'
        ]);


        $fileName = time() . '_' . $request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

        Image::make(storage_path().'/app/public/uploads/'.$fileName)
            ->fit(240,320)
            ->save();

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename' => $fileName,
            'filepath' => '/storage/' . $filePath,
        ]);

        $buku->save(); // Menyimpan perubahan ke database

   
        // dd($buku, $fileName);

        return redirect('/buku')->with('pesan', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('pesan', 'Buku berhasil dihapus.');
    }
}