<?php

namespace Modules\Product\Database\Factories;

use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'name' => $this->faker->word(3),
            'image_path' => 'products/' . $this->faker->image("public/storage/products",  400, 300, null, false),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'subcategory_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}