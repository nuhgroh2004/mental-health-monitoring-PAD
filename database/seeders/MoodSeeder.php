<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MoodTracker;
use Carbon\Carbon;

class moodSeeder extends Seeder
{
    public function run()
    {
        $mahasiswaId = 1; // ID mahasiswa yang ditargetkan
        $days = 90; // Total hari untuk data
        $today = Carbon::today();

        for ($i = 0; $i < $days; $i++) {
            $date = $today->copy()->subDays($i); // Tanggal mundur selama 90 hari
            $hasMood = rand(0, 1); // Tentukan apakah mood diisi atau tidak

            if ($hasMood) {
                $moodLevel = rand(1, 4);
                $moodIntensity = rand(1, 3);
                $notes = rand(0, 1) ? 'Catatan mood pada ' . $date->toDateString() : null; // Terkadang ada catatan
            } else {
                $moodLevel = null;
                $moodIntensity = null;
                $notes = null; // Tidak ada catatan jika mood tidak diisi
            }

            // Buat data mood
            MoodTracker::create([
                'mahasiswa_id' => $mahasiswaId,
                'mood_level' => $moodLevel,
                'mood_intensity' => $moodIntensity,
                'mood_note' => $notes,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
