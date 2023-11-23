<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $randomPot = fake()->numberBetween(1, 5);
        // $randomSho = fake()->numberBetween(1, 3);
        // $randomSoil = fake()->numberBetween(1, 2);

        // $potFilename =  'pot' . (string)$randomPot . '.png';
        // $shovelFilename =  'shovel' . (string)$randomSho . '.png';
        // $soilFilename =  'soil' . (string)$randomSoil . '.jpeg';

        $potCategoryId = DB::table('category')->where('type', 'Product')->where('name', 'Pot')->value('id');
        $shovelCategoryId = DB::table('category')->where('type', 'Product')->where('name', 'Shovel')->value('id');
        $soilCategoryId = DB::table('category')->where('type', 'Product')->where('name', 'Soil')->value('id');

        for ($i = 10; $i < 20; $i++) {
            $randomPot = fake()->numberBetween(1, 5);
            $randomSho = fake()->numberBetween(1, 3);
            $randomSoil = fake()->numberBetween(1, 2);

            $potFilename =  'pot' . (string)$randomPot . '.png';
            $shovelFilename =  'shovel' . (string)$randomSho . '.png';
            $soilFilename =  'soil' . (string)$randomSoil . '.jpeg';

            DB::table('product')->insertOrIgnore([
                [
                    'name' => "pot" . $i,
                    'price' =>  fake()->randomFloat(2, 1, 100),
                    'description' => fake()->paragraph() . fake()->paragraph() . fake()->paragraph(),
                    'quantity' => fake()->numberBetween(1, 1000),
                    'status' => "1",
                    'image' =>  $potFilename,
                    'cat_id' => $potCategoryId,
                ],
                [
                    'name' => "shovel" . $i,
                    'price' =>  fake()->randomFloat(2, 1, 100),
                    'description' => fake()->paragraph() . fake()->paragraph() . fake()->paragraph(),
                    'quantity' => fake()->numberBetween(1, 1000),
                    'status' => "1",
                    'image' =>  $shovelFilename,
                    'cat_id' => $shovelCategoryId,
                ],
                [
                    'name' => "soil" . $i,
                    'price' =>  fake()->randomFloat(2, 1, 100),
                    'description' => fake()->paragraph() . fake()->paragraph() . fake()->paragraph(),
                    'quantity' => fake()->numberBetween(1, 1000),
                    'status' => "1",
                    'image' =>  $soilFilename,
                    'cat_id' => $soilCategoryId
                ],
            ]);
        }
        // Product::Factory()->count(100)->create();
    }
}
