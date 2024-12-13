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
            'NIM' => $this->faker->regexify('\d{2}/\d{6}/[A-Z]{2}/\d{5}'),
            'prodi' => $this->faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro']),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-18 years'), // Minimal 18 tahun ke atas
            'nomor_hp' => $this->faker->regexify('\d{11}'), // Nomor HP sepanjang 11 digit
            'mahasiswa_role' => 'role_1',
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
