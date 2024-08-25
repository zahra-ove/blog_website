<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if(app()->environment('local')) {
            // temporarily disable FK check
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            User::truncate();
            User::factory()->create([
                'first_name' => 'Test',
                'last_name' => 'User',
                'username' => 'something',
                'email' => 'test@example.com',
            ]);

            $this->call([
                CategorySeeder::class,
                PostSeeder::class,
                CommentSeeder::class,
                TagSeeder::class,
            ]);

            // enable FK check
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

    }
}
