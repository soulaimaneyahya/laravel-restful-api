<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'quantity' => fake()->numberBetween(1,3),
            'created_at' => fake()->dateTimeBetween('-3 weeks'),
            'updated_at' => fake()->dateTimeBetween('-3 weeks'),
        ];
    }
}
