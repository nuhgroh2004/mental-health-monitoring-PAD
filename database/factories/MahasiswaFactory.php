<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    public function definition()
    {
        return [
            'NIM' => $this->faker->numerify('###########'),
            'prodi' => 'Teknik Informatika',
            'tanggal_lahir' => $this->faker->date(),
            'nomor_hp' => $this->faker->numerify('###########'),
            'mahasiswa_role' => 'role_1'
        ];
    }

    // State untuk role_2
    public function roleTwo()
    {
        return $this->state(function (array $attributes) {
            return [
                'mahasiswa_role' => 'role_2',
            ];
        });
    }
}
