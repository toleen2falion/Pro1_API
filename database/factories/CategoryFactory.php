<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            "created_at" => fake()->dateTimeThisMonth(),
            "superCategory_id" => fake()->numberBetween($min = 1, $max = 250),
        ];
    }
}
