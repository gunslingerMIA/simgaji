<?php

namespace Database\Factories;

use App\Models\RefGajiPokokPppk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RefGajiPokokPppk>
 */
class RefGajiPokokPppkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'golongan' => fake()->randomElement(['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X']),
            'mkg' => fake()->numberBetween(0, 32),
            'nominal' => fake()->numberBetween(1500000, 5000000),
        ];
    }
}
