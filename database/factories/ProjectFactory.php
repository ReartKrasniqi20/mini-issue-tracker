<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 month', '+1 week');

        return [
            'owner_id' => User::factory(),
            'name' => ucfirst(fake()->unique()->words(2, true)),
            'description' => fake()->paragraph(),
            'start_date' => $start,
            'deadline' => fake()->dateTimeBetween($start, '+2 months'),
        ];
    }
}
