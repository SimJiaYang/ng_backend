<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomPlantCategoryId = Category::where('type', 'Plant')->inRandomOrder()->value('id');
        return [
            'name' => fake()->name(),
            'quantity' => fake()->numberBetween(0, 10),
            'cat_id' =>  $randomPlantCategoryId,
            'price' => fake()->randomFloat(2, 1, 100),
            'description' => fake()->paragraph(),
            'sunlight_need' => fake()->randomElement(['Full', 'Partial', 'Shade']),
            'water_need' => fake()->randomElement(['High', 'Moderate', 'Low']),
            'mature_height' => fake()->numberBetween(0, 10),
            'origin' => fake()->country(),
            'image' => "no_plant.png",
            'status' => "1",
        ];
    }
}
