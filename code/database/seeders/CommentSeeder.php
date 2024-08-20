<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::truncate();

        Comment::factory()->count(30)->create();
        Comment::factory()->count(10)->withParent()->create();
    }
}
