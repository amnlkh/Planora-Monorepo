<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'user_id'     => User::factory(), // Relasi ke UserFactory
            'title'       => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'deadline'    => $this->faker->dateTimeBetween('now', '+1 month'),
            'status'      => 'pending',
        ];
    }
}