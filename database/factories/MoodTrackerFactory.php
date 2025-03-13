<?php

namespace Database\Factories;

use App\Models\MoodTracker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class MoodTrackerFactory extends Factory
{
    protected $model = MoodTracker::class;

    public function definition()
    {
        $hasMood = $this->faker->boolean();

        return [
            'mahasiswa_id' => 1,
            'mood_level' => $hasMood ? $this->faker->numberBetween(1, 4) : null,
            'mood_intensity' => $hasMood ? null : null, // Diisi null dulu
            'mood_note' => $hasMood ? $this->faker->optional()->sentence() : null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // State untuk mengatur tanggal spesifik
    public function forDate($date)
    {
        return $this->state(fn(array $attributes) => [
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }

    public function forMahasiswaRole($role)
    {
        return $this->state(function (array $attributes) use ($role) {
            // Kalau ada data mood, baru isi mood_intensity
            if ($attributes['mood_level'] !== null) {
                return [
                    'mood_intensity' => $this->faker->numberBetween(
                        $role === '1' ? 1 : 1,
                        $role === '1' ? 5 : 10
                    )
                ];
            }

            // Kalau mood null, intensity tetap null
            return [];
        });
    }
}
