<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::truncate();

        Tag::factory()
            ->hasAttached(
//                Post::factory()->count(3),
                Post::inRandomOrder()->take(3)->get('id'),
                ['created_at' => now()]
            )
            ->count(10)
            ->create();
    }
}
