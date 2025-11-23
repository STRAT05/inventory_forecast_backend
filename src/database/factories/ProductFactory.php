<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->word(), // Generates a single word
            'description' => fake()->sentence(), // Generates a short sentence
            'price' => fake()->randomFloat(2, 1, 1000), // Price between 1 and 1000
            'stock' => fake()->numberBetween(0, 100), // Stock between 0 and 100
            'purchases' => fake()->numberBetween(0, 500), // Purchases between 0 and 500
            'image' => fake()->imageUrl(640, 480, 'products', true), // Generates a placeholder image URL
            'average_weekly_sales' => fake()->randomFloat(2, 0, 100), // Average weekly sales between 0 and 100
            'lead_time' => fake()->numberBetween(1, 30), // Lead time
        ];
    }
}
