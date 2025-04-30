<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Category::pluck('id')->toArray();

        $chunkSize = 1000;
        $totalProducts = 100000;

        for ($i = 0; $i < $totalProducts; $i += $chunkSize) {
            $products = [];
            for ($j = 0; $j < $chunkSize && ($i + $j) < $totalProducts; $j++) {
                $products[] = [
                    'name' => $faker->sentence(3),
                    'category_id' => $faker->randomElement($categories),
                    'price' => $faker->randomFloat(2, 10, 1000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Product::insert($products);
        }
    }
}