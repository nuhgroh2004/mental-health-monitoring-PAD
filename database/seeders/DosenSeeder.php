<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Dosen::create([
            'name' => 'Dosen Temp',
            'email' => 'Temp1@ugm.ac.id',
            'password' => bcrypt('12345678'),
            'verified' => 'yes'
        ]);
    }
}
