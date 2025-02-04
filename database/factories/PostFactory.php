<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

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
            'title'=>fake()->sentence(),
            'slug'=>Str::slug(fake()->sentence()),
            'author_id'=>User::factory(),
            'category_id'=>Category::factory(),
            'views'=>fake()->numberBetween(0, 1000),
            'body'=>fake()->text(),

            //
        ];
    }
}
