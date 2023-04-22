<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenggunaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomFakultas = rand(0, 7);
        switch ($randomFakultas) {
            case 0:
                $fakultas = 'FKIP';
                break;

            case 1:
                $fakultas = 'Ekonomi';
                break;

            case 2:
                $fakultas = 'Pertanian';
                break;

            case 3:
                $fakultas = 'Teknik';
                break;

            case 4:
                $fakultas = 'Hukum';
                break;

            case 5:
                $fakultas = 'FISIP';
                break;

            case 6:
                $fakultas = 'Dokter';
                break;

            case 7:
                $fakultas = 'MIPA';
                break;
        }

        return [
            'nama' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'jenis_kelamin' => rand(0, 1) ? 'L' : 'P',
            'email' => $this->faker->unique()->safeEmail(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address(),
            'fakultas' => $fakultas,
            'jurusan' => $this->faker->jobTitle(),
            'nim' => $this->faker->randomNumber(8),
            'nik' => $this->faker->randomNumber(8),
            'no_hp' => $this->faker->phoneNumber(),
            'role' => rand(1, 0) ? 'PENGURUS' : 'ANGGOTA',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
