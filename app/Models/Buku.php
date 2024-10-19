<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Menyatakan bahwa model ini menggunakan tabel 'books' di dalam database
    protected $table = 'books';

    // Properti yang diizinkan untuk mass assignment
    protected $fillable = [
        'judul',
        'penulis',
        'harga',
        'tgl_terbit'
    ];

    // Cast 'tgl_terbit' ke tipe 'date'
    protected $casts = [
        'tgl_terbit' => 'date', // atau bisa juga 'datetime'
    ];
}
