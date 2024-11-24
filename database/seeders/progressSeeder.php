<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\ProgressTracker;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class progressSeeder extends Seeder
{
    public function run()
    {
        // Ambil 1 mahasiswa role_1
        $mahasiswaRole1 = Mahasiswa::where('mahasiswa_role', 'role_1')
            ->first();

        // Ambil 1 mahasiswa role_2
        $mahasiswaRole2 = Mahasiswa::where('mahasiswa_role', 'role_2')
            ->first();

        $mahasiswas = [$mahasiswaRole1, $mahasiswaRole2];

        foreach ($mahasiswas as $mahasiswa) {
        $days = 90;
        $today = Carbon::today();

        for ($i = 0; $i < $days; $i++) {
            $date = $today->copy()->subDays($i);

            ProgressTracker::factory()
                ->forDate($date)
                ->create([
                    'mahasiswa_id' => $mahasiswa->mahasiswa_id
                ]);
            }
        }
    }
}
