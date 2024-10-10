<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Mahasiswa::create([
            'name' => 'Mahasiswa 1',
            'email' => 'mahasiswa1@student.university.ac.id',
            'NIM' => '1234567890123',
            'password' => bcrypt('password'),
            'phone_number' => '0812345678'
        ]);

        Mahasiswa::create([
            'name' => 'Mahasiswa 2',
            'email' => 'mahasiswa2@student.university.ac.id',
            'NIM' => '2345678901234',
            'password' => bcrypt('password'),
            'phone_number' => '0823456789'
        ]);

        Mahasiswa::create([
            'name' => 'Mahasiswa 3',
            'email' => 'mahasiswa3@student.university.ac.id',
            'NIM' => '3456789012345',
            'password' => bcrypt('password'),
            'phone_number' => '0834567890'
        ]);
    }
}
