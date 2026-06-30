<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'    => User::factory(), // Laravel secara otomatis akan membuat User baru
            'title'      => $this->faker->sentence(3), // Menggunakan 3 kata agar lebih realistis
            'date'       => $this->faker->date('Y-m-d'), // Menggunakan faker agar tanggal bervariasi
            'start_time' => '09:00',
            'end_time'   => '10:00',
            'note'       => $this->faker->optional()->sentence(), // Menggunakan optional agar tidak selalu ada isi
        ];
    }
}