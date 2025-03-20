<?php

namespace Database\Seeders;

use App\Models\MahasiswaRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class mahasiswaRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MahasiswaRole::create([
            "mahasiswa_role_id" => "1",
            "name" => "Skala 1-5",
            "min_intensity" => "1",
            "max_intensity" => "5"
        ]);

        MahasiswaRole::create([
            "mahasiswa_role_id" => "2",
            "name" => "Skala 1-10",
            "min_intensity" => "1",
            "max_intensity" => "10"
        ]);

        MahasiswaRole::create([
            "mahasiswa_role_id" => "3",
            "name" => "Contoh 3-4",
            "min_intensity" => "3",
            "max_intensity" => "4"
        ]);
    }
}
