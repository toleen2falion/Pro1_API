<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\Category;

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
    public function definition(): array
    {
        return [
            //
            "name" => fake()->unique()->sentence(1),
            "price" => fake()->numberBetween($min = 1500, $max = 6000),
            "created_at" => fake()->dateTimeThisMonth(),
            // "category_id" => Category::factory(),
            "category_id" => fake()->numberBetween($min = 1, $max = 1000),
        ];
    }
}
