<?php

namespace Database\Factories;

use App\Models\RefGajiPokokPns;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RefGajiPokokPns>
 */
class RefGajiPokokPnsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'golongan' => fake()->randomElement(['I/a', 'I/b', 'II/a', 'II/b', 'III/a', 'III/b', 'IV/a', 'IV/b']),
            'mkg' => fake()->numberBetween(0, 32),
            'nominal' => fake()->numberBetween(1500000, 5000000),
        ];
    }
}
