<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_cek' => $this->faker->unique()->randomNumber(8),
            'jumlah' => $this->faker->randomNumber(6),
            'jenis' => $this->faker->randomElement(['Masuk', 'Keluar']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
