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
            'name' => 'Mahasiswa Temp',
            'email' => 'Temp1@mail.ugm.ac.id',
            'NIM' => '23SV51925423148',
            'prodi' => 'Information Technology',
            'tanggal_lahir' => '1999-05-15',
            'password' => bcrypt('12345678'),
            'phone_number' => '08123456780',
        ]);
    }
}
