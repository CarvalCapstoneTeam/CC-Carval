<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->sentence(),
            'news_writer' => $this->faker->name(),
            'source' => $this->faker->company(),
            'source_date' => $this->faker->date(),
            'description' => $this->faker->sentence(),
            'thumbnail' => 'https://source.unsplash.com/random/450×800/?job',
            'content' => $this->faker->paragraphs(3, true),
        ];
    }
}
