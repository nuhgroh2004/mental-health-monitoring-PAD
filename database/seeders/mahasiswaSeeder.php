<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class mahasiswaSeeder extends Seeder
{
    public function run()
    {
        // Buat mahasiswa pertama (fixed data)
        $firstUser = User::create([
            'name' => 'Mahasiswa1',
            'email' => 'mahasiswa@mail.ugm.ac.id',
            'password' => Hash::make('ABCD1234'),
            'role' => 'Mahasiswa',
        ]);

        Mahasiswa::create([
            'mahasiswa_id' => $firstUser->user_id,
            'NIM' => '23/519254/SV/23148',
            'prodi' => 'Teknik Informatika',
            'tanggal_lahir' => '2000-01-01',
            'nomor_hp' => '12345678901',
            'mahasiswa_role_id' => '1'
        ]);

        // Buat 5 mahasiswa role_1
        User::factory()
            ->count(5)
            ->state(fn (array $attributes) => [
                'role' => 'Mahasiswa',
            ])
            ->has(
                Mahasiswa::factory()
            )
            ->create();

        // Buat 5 mahasiswa role_2
        User::factory()
            ->count(5)
            ->state(fn (array $attributes) => [
                'role' => 'Mahasiswa',
            ])
            ->has(
                Mahasiswa::factory()->roleTwo()
            )
            ->create();
    }
}
