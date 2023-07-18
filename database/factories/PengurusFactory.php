<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengurus>
 */
class PengurusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pengurus' => fake()->name(),
            'latar_belakang' => fake()->randomElement([
                'Dosen FH',
                'Mahasiswa FH',
                'Tendik',
                'Dosen Psikologi',
                'Mahasiswa Psikologi'
            ]),
            'jabatan_id' => fake()->randomElement([
                '1', '2', '3'
            ]),
            'periode_id' => fake()->randomElement([
                '1', '2', '3'
            ])
        ];
    }
}
