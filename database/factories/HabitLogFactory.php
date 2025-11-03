<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Habit;
use Illuminate\Database\Eloquent\Factories\Factory;

class HabitLogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'habit_id' => Habit::factory(),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(Status::ALL()),
            'note' => $this->faker->sentence(),
        ];
    }
}
