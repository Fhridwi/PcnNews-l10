<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'summary' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(3, true),
            'cover_image_url' => $this->faker->imageUrl(),
            'publish_status' => $this->faker->randomElement(['draft', 'published']),
            'published_at' => $this->faker->dateTimeThisYear(),
            'view_count' => $this->faker->numberBetween(0, 1000),
            'author_id' => User::factory(), 
        ];
    }
}
