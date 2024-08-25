<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'slug' => $this->faker->unique()->slug,
            'category_id' => Category::inRandomOrder()->first()->id ?? null, // Assumes a parent category is also created
            'created_at'  => now(),
            'updated_at'  => now(),
            'deleted_at'  => null,
        ];
    }

    public function withoutParent()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => null,
            ];
        });
    }
}
