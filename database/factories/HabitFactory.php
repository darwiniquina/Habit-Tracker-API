<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HabitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'frequency' => 'daily',
            'color' => $this->faker->hexColor(),
            'reminder_time' => $this->faker->time(),
        ];
    }
}
