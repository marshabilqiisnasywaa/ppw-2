<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

//menampilkan atau me-return view home (home.blade.php).
// Route::get('/', function () {
//     return view('home');
// });

//menampilkan atau me-return view about (about.blade.php).
// Route::get('/about', function () {
//     return view('about');
// });

Route::get('/posts', [PostController::class, 'index']);





