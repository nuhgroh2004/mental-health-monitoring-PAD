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
            'mood_intensity' => $hasMood ? $this->faker->numberBetween(1, 3) : null,
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
}
