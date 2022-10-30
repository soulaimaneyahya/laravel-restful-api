<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
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
            'name' => fake()->sentence($nbWords = 3),
            'description' => fake()->paragraph($nbSentences = 3),
            'quantity' => fake()->numberBetween(1, 10),
            'status' => fake()->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
            'image' => fake()->randomElement(['1.jpeg', '2.jpeg', '3.jpeg']),
            'seller_id' => User::all()->random()->id,
            // User::inRandomOrder()->first()->id
        ];
    }
}
