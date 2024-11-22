<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgressTracker;
use Carbon\Carbon;

class progressSeeder extends Seeder
{
    public function run()
    {
        $mahasiswaId = 1; // ID mahasiswa yang ditargetkan
        $days = 90; // Total hari untuk data
        $today = Carbon::today();

        for ($i = 0; $i < $days; $i++) {
            $date = $today->copy()->subDays($i); // Tanggal mundur selama 90 hari

            $expectedTarget = rand(3600, 14400); // Waktu target dalam detik (1 hingga 4 jam)
            $actualTarget = rand(3000, $expectedTarget); // Waktu yang tercapai (lebih kecil atau sama dengan target)
            $isAchieved = $actualTarget >= $expectedTarget; // Cek apakah target tercapai

            // Buat data progress
            ProgressTracker::create([
                'mahasiswa_id' => $mahasiswaId,
                'expected_target' => $expectedTarget,
                'actual_target' => $actualTarget,
                'is_achieved' => $isAchieved,
                'tracking_date' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
