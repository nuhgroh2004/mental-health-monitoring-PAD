<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\MoodTracker;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class moodSeeder extends Seeder
{
    public function run()
    {
        // Ambil 1 mahasiswa role_1
        $mahasiswaRole1 = Mahasiswa::where('mahasiswa_role', 'role_1')
            ->first();

        // Ambil 1 mahasiswa role_2
        $mahasiswaRole2 = Mahasiswa::where('mahasiswa_role', 'role_2')
            ->first();

        $mahasiswas = [
            ['mahasiswa' => $mahasiswaRole1, 'role' => 'role_1'],
            ['mahasiswa' => $mahasiswaRole2, 'role' => 'role_2']
        ];

        $days = 90;
        $today = Carbon::today();

        foreach ($mahasiswas as $data) {
            $mahasiswa = $data['mahasiswa'];
            $role = $data['role'];

        for ($i = 0; $i < $days; $i++) {
            $date = $today->copy()->subDays($i);

            MoodTracker::factory()
                ->forDate($date)
                ->forMahasiswaRole($role)
                ->create([
                    'mahasiswa_id' => $mahasiswa->mahasiswa_id
                ]);
            }
        }
    }
}
