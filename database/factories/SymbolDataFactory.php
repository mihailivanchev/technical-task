<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'mid' => fake()->randomNumber(5),
            'bid' => fake()->randomNumber(5),
            'ask' => fake()->randomNumber(5),
            'last_price' => fake()->randomNumber(5),
            'low' => fake()->randomNumber(5),
            'high' => fake()->randomNumber(5),
            'volume' => fake()->randomNumber(8),
            'timestamp' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
