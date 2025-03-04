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
        $dosenUser = User::create([
            'name' => 'Dosen1',
            'email'=> 'dosen@ugm.ac.id',
            'password'=> Hash::make('ABCD1234'),
            'role' => 'Dosen',
        ]);

        Dosen::create([
            'dosen_id' => $dosenUser->user_id,
            'verified' => 'yes',
        ]);
    }
}
