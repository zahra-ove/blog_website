<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body'       => $this->faker->text(),
            'user_id'    => User::all()->random()->id,
            'post_id'    => Post::all()->random()->id,
            'confirmed'  => $this->faker->randomElement(['pending', 'confirmed', 'rejected']),
            'comment_id' => null,
        ];
    }

    public function withParent()
    {
        return $this->state(function (array $attributes) {
            return [
                'comment_id' => Comment::all()->random()->id,
            ];
        });
    }
}
