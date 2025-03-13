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
        // Ambil 1 mahasiswa role 1
        $mahasiswaRole1 = Mahasiswa::where('mahasiswa_role_id', 1)
            ->first();

        // Ambil 1 mahasiswa role 2
        $mahasiswaRole2 = Mahasiswa::where('mahasiswa_role_id', 2)
            ->first();

        $mahasiswas = [
            ['mahasiswa' => $mahasiswaRole1, 'role' => '1'],
            ['mahasiswa' => $mahasiswaRole2, 'role' => '2']
        ];

        $days = 90;
        $today = Carbon::today();

        foreach ($mahasiswas as $data) {
            $mahasiswa = $data['mahasiswa'];
            $role = $data['role'];

            for ($i = 0; $i < $days; $i++) {
                $date = $today->copy()->subDays($i);

                // Generate data mood
                $mood = MoodTracker::factory()
                    ->forDate($date)
                    ->forMahasiswaRole($role)
                    ->make([
                        'mahasiswa_id' => $mahasiswa->mahasiswa_id
                    ]);

                // Jika mood_level null, skip penyimpanan data
                if ($mood->mood_level !== null) {
                    $mood->save();
                }
            }
        }
    }
}
