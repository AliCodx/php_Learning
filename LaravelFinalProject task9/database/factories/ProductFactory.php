<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
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
        $name = fake()->randomElement([
            'Embroidered Lawn Suit',
            'Leather Wallet',
            'Marble Serving Tray',
            'Rose Glow Serum',
            'Handwoven Storage Basket',
            'Fast Charge Power Bank',
            'Ceramic Tea Set',
            'Velvet Cushion Cover',
        ]);

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numerify('###'),
            'sku' => 'PK-' . Str::upper(fake()->bothify('??####')),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 1200, 18000),
            'stock' => fake()->numberBetween(5, 80),
            'image_url' => '/images/products/home-decor.jpg',
            'is_featured' => fake()->boolean(40),
            'is_active' => true,
        ];
    }
}
