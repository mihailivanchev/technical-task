<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class SymbolDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'symbol_id' => 1,
            'mid' => fake()->numberBetween(20000, 23500),
            'bid' => fake()->numberBetween(20000, 23500),
            'ask' => fake()->numberBetween(20000, 23500),
            'last_price' => fake()->numberBetween(20000, 23500),
            'low' => fake()->numberBetween(20000, 23500),
            'high' => fake()->numberBetween(20000, 23500),
            'volume' => fake()->randomNumber(8),
            'timestamp' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
