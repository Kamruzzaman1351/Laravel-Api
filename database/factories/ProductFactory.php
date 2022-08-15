<?php

namespace Database\Factories;

use Faker\Core\Number;
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
            'name' => fake()->name(), 
            'description' => fake()->paragraph(2), 
            'price' => fake()->numberBetween($min = 1000, $max = 9000), 
            'sku' => fake()->numberBetween($min = 100, $max = 2000), 
            'is_active' => fake()->boolean(), 
            'quantity' => fake()->numberBetween($min =10, $max =100),
        ];
    }
}
