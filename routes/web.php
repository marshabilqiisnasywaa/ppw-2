<?php

 use App\Http\Controllers\PostController;
// use Illuminate\Support\Facades\Route; -->

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/about', function () {
//     return view('about',[
//         "name" => "lala",
//         "email" => "lala@gmail.com"
//         ]);
// });

// menampilkan atau me-return view home (home.blade.php).
Route::get('/', function () {
    return view('home');
});

//menampilkan atau me-return view about (about.blade.php).
// Route::get('/about', function () {
//     return view('about');
// });

//
Route::get('/posts', [PostController::class, 'index']);

// use App\Http\Controllers\StudentController;

// Route::get('/students', [StudentController::class, 'index']);


use App\Http\Controllers\BukuController;

// Route untuk menampilkan daftar buku
//ketika user atau kita mengakses /buku (slice buku) kita akan masuk ke dalam coontroller, Buku Controller. lalu kita akan masuk ke dalam function yang namanya 'index'
//function dari index ini isinya adalah return view buku.index (buka BukuController.php lihat function index, di pling bawah ada return view)
// buku.index ini akan menampilkan sebuah halaman (buka resource>views>buku>index.blade)
// halamannya bentuk html dengan format blade.
// jadi ketika ada user yang mengakses /buku ini yang tampil adalah HTML yang tadi
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

// Route untuk menampilkan form tambah buku
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');

// Route untuk menyimpan buku baru
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');

// Route untuk menghapus buku berdasarkan ID
Route::post('/buku/{id}/destroy', [BukuController::class, 'destroy'])->name('buku.destroy');

// Route untuk menampilkan form edit
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');

// Route untuk memproses update
Route::put('/buku/{id}/update', [BukuController::class, 'update'])->name('buku.update');

// Route untuk menampilkan detail buku
Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');

// Route untuk menampilkan fitur searching
// web.php

Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

Route::get('/bukudatatable', [BukuController::class, 'indexdatatable'])->name('buku.indexdatatable');















