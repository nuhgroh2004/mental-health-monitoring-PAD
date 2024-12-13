<?php

namespace Database\Factories;

use App\Models\ProgressTracker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ProgressTrackerFactory extends Factory
{
    protected $model = ProgressTracker::class;

    public function definition()
    {
        $expectedTarget = $this->faker->numberBetween(3600, 14400);
        $actualTarget = $this->faker->numberBetween(3000, $expectedTarget);

        return [
            'mahasiswa_id' => 1,
            'expected_target' => $expectedTarget,
            'actual_target' => $actualTarget,
            'is_achieved' => $actualTarget >= $expectedTarget,
            'tracking_date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // State untuk mengatur tanggal spesifik
    public function forDate($date)
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'tracking_date' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        });
    }
}
