<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

class dosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data untuk 5 dosen
        $dosenData = [
                        [
                'name' => 'Dosen1',
                'email' => 'dosen@ugm.ac.id',
                'password' => 'ABCD1234'
            ],
            [
                'name' => 'Dr. Ahmad Wijaya',
                'email' => 'ahmad.wijaya@ugm.ac.id',
                'password' => 'ABCD1234'
            ],
            [
                'name' => 'Prof. Siti Nurhaliza',
                'email' => 'siti.nurhaliza@ugm.ac.id', 
                'password' => 'EFGH5678'
            ],
            [
                'name' => 'Dr. Budi Santoso',
                'email' => 'budi.santoso@ugm.ac.id',
                'password' => 'IJKL9012'
            ],
            [
                'name' => 'Dr. Rina Kartika',
                'email' => 'rina.kartika@ugm.ac.id',
                'password' => 'MNOP3456'
            ],
            [
                'name' => 'Prof. Hendra Gunawan',
                'email' => 'hendra.gunawan@ugm.ac.id',
                'password' => 'QRST7890'
            ]
        ];

        // Loop untuk membuat 5 user dosen
        foreach ($dosenData as $data) {
            $dosenUser = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'Dosen',
            ]);

            Dosen::create([
                'dosen_id' => $dosenUser->user_id,
                'verified' => 'yes',
            ]);
        }
    }
}