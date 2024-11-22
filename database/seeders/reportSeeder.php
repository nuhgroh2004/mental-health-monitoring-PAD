<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\MoodTracker;
use App\Models\ProgressTracker;
use Carbon\Carbon;

class reportSeeder extends Seeder
{
    public function run()
    {
        $mahasiswaId = 1; // ID mahasiswa yang ditargetkan
        $days = 90; // Total hari untuk data
        $today = Carbon::today();

        for ($i = 0; $i < $days; $i++) {
            $date = $today->copy()->subDays($i); // Tanggal mundur selama 90 hari

            // Ambil mood dan progress berdasarkan tanggal
            $mood = MoodTracker::where('mahasiswa_id', $mahasiswaId)
                ->whereDate('created_at', $date)
                ->first();

            $progress = ProgressTracker::where('mahasiswa_id', $mahasiswaId)
                ->whereDate('tracking_date', $date)
                ->first();

            // Buat report yang menghubungkan mood dan progress
            Report::create([
                'mahasiswa_id' => $mahasiswaId,
                'mood_id' => $mood ? $mood->mood_id : null,
                'progress_id' => $progress ? $progress->progress_id : null,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
