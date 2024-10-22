<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Buku::create([
                'judul' => fake()->sentence(nbWords: 3),
                'penulis' => fake()->name(),
                'harga' => fake()->numberBetween(int1: 10000, int2: 50000),
                'tgl_terbit' => fake()->date(),
            ]);
        }
    }
}
