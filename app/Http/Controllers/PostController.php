<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function index()
    {
        return view('posts');
    }

    /**
     * Menampilkan form untuk membuat sumber daya baru.
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan sumber daya baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Menampilkan sumber daya yang ditentukan.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit sumber daya yang ditentukan.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Memperbarui sumber daya yang ditentukan di dalam penyimpanan.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Menghapus sumber daya yang ditentukan dari penyimpanan.
     */
    public function destroy(string $id)
    {
        //
    }
}
