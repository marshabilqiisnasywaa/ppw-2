<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Validator;

class BookApiController extends Controller
{
    // Method untuk menampilkan data buku (yang sudah ada sebelumnya)
    public function index()
    {
        $books = Buku::latest()->paginate(5);
        return new BookResource(true, 'List Data Buku', $books);
    }

    // Method untuk menambahkan data buku baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|integer',
            'tgl_terbit' => 'required|date',
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Menyimpan data buku ke dalam database
        $book = Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
        ]);

        // Mengembalikan respons sukses
        return new BookResource(true, 'Book Created Successfully', $book);
    }
}
