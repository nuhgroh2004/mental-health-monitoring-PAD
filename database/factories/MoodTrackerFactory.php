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
            'mood_intensity' => null,
            'mood_note' => $hasMood ? $this->faker->optional()->sentence() : null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // State untuk mengatur tanggal spesifik
    public function forDate($date)
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'created_at' => $date,
                'updated_at' => $date,
            ];
        });
    }

    public function forMahasiswaRole($role)
    {
        return $this->state(fn(array $attributes) => [
            'mood_intensity' => $this->faker->numberBetween(
                $role === 'role_1' ? 1 : 1, // Min sama untuk keduanya
                $role === 'role_1' ? 5 : 10  // Max 5 untuk role_1, 10 untuk role_2
            ),
        ]);
    }
}
