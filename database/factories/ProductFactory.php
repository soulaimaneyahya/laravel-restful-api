<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'name' => fake()->sentence($nbWords = 3),
            'description' => fake()->paragraph($nbSentences = 3),
            'quantity' => fake()->numberBetween(1, 10),
            'status' => fake()->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
            'image' => fake()->randomElement(['1.jpeg', '2.jpeg', '3.jpeg']),
            'seller_id' => User::all()->random()->id,
            'created_at' => fake()->dateTimeBetween('-3 weeks'),
            'updated_at' => fake()->dateTimeBetween('-3 weeks'),
            // User::inRandomOrder()->first()->id
        ];
    }
}
