<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Cattegory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        Post::factory(100)->recycle([
            User::factory(10)->create(),
            Cattegory::factory(5)->create(),
        ])->create();

    }
}
