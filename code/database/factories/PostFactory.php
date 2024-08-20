<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'        => $this->faker->words(3, true),
            'body'         => $this->faker->randomHtml(),
            'author_id'    => User::all()->random()->id,
            'category_id'  => Category::all()->random()->id,
            'published'    => $this->faker->randomElement(['0', '1']),
            'publish_at'   => $this->faker->dateTimeThisMonth,
            'published_at' => $this->faker->dateTimeBetween(startDate: now()->addMonth(), endDate: now()->addYear()),
        ];
    }
}
