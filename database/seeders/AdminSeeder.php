<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Admin::create([
            'name' => 'Dosen 1',
            'email' => 'dosen1@university.ac.id',
            'password' => bcrypt('password'),
            'verified' => 'yes'
        ]);

        Admin::create([
            'name' => 'Dosen 2',
            'email' => 'dosen2@university.ac.id',
            'password' => bcrypt('password'),
            'verified' => 'yes'
        ]);
    }
}
