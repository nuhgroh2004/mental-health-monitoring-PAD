<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Report;
use App\Models\MoodTracker;
use App\Models\ProgressTracker;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class reportSeeder extends Seeder
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

                // Ambil mood dan progress yang sudah dibuat untuk tanggal tersebut
                $mood = MoodTracker::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
                    ->whereDate('created_at', $date)
                    ->first();

                $progress = ProgressTracker::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
                    ->whereDate('tracking_date', $date)
                    ->first();

                Report::create([
                    'mahasiswa_id' => $mahasiswa->mahasiswa_id,
                    'mood_id' => $mood?->mood_id,
                    'progress_id' => $progress?->progress_id,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
