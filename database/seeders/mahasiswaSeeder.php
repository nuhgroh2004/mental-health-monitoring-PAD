<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class mahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $mahasiswaUser = User::create([
            'name' => 'Mahasiswa1',
            'email'=> 'mahasiswa@mail.ugm.ac.id',
            'password'=> Hash::make('12345678'),
            'role' => 'Mahasiswa',
        ]);

        Mahasiswa::create([
            'mahasiswa_id' => $mahasiswaUser->user_id,
            'NIM' => '1234567890123',
            'prodi' => 'Teknik Informatika',
            'tanggal_lahir' => '2000-01-01',
            'nomor_hp' => '12345678901',
            'mahasiswa_role' => 'role_1'
        ]);

        for ($i = 0; $i < 5; $i++) {
            $mahasiswaUser = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('12345678'),
                'role' => 'Mahasiswa',
            ]);

            Mahasiswa::create([
                'mahasiswa_id' => $mahasiswaUser->user_id,
                'NIM' => fake()->numerify('###########'),
                'prodi' => 'Teknik Informatika',
                'tanggal_lahir' => fake()->date(),
                'nomor_hp' => fake()->numerify('###########'),
                'mahasiswa_role' => 'role_1',
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            $mahasiswaUser = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('12345678'),
                'role' => 'Mahasiswa',
            ]);

            Mahasiswa::create([
                'mahasiswa_id' => $mahasiswaUser->user_id,
                'NIM' => fake()->numerify('###########'),
                'prodi' => 'Teknik Informatika',
                'tanggal_lahir' => fake()->date(),
                'nomor_hp' => fake()->numerify('###########'),
                'mahasiswa_role' => 'role_2',
            ]);
        }
    }
}
