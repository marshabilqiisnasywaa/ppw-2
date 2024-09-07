<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'name' => 'Marsha Bilqiis Nasywaa',
            'nim' => '23/520452/SV/23242',
            'role' => 'UI/UX'
        ]);

        Student::create([
            'name' => 'Septyan',
            'nim' => '23/654321/SV/12345',
            'role' => 'Project Manager'
        ]);

        Student::create([
            'name' => 'Deandra',
            'nim' => '23/123456/SV/12345',
            'role' => 'Frontend Developer'
        ]);

        Student::create([
            'name' => 'Joe',
            'nim' => '23/654321/SV/78910',
            'role' => 'Backend Developer'
        ]);
    }
}
