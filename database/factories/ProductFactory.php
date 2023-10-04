<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use function Database\Factories\getCategoryID as FactoriesGetCategoryID;

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
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2, 1, 100),
            'description' => fake()->paragraph(),
            'quantity' => fake()->numberBetween(0, 10),
            'status' => "1",
            'image' => "no_product.png",
            'cat_id' => getCategoryID(),
        ];
    }
}

function getCategoryID()
{
    $result = fake()->boolean(50);
    if ($result) {
        $number = 6;
    } else {
        $number = 7;
    }
    return $number;
}
