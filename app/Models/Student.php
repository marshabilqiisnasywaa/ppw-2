<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false; // Nonaktifkan timestamps

    protected $fillable = ['name', 'nim', 'role']; // Kolom yang dapat diisi
}
