<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
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
        $name = fake()->randomElement([
            'Women Fashion',
            'Men Fashion',
            'Home Decor',
            'Beauty Essentials',
            'Kitchen Picks',
            'Mobile Accessories',
            'Gift Corner',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numerify('##'),
            'description' => fake()->sentence(12),
            'is_active' => true,
        ];
    }
}
