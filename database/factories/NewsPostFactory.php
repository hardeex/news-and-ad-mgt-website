<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\NewsPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsPostFactory extends Factory
{
    protected $model = NewsPost::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'category' => $this->faker->randomElement(['nigeria', 'world', 'politics', 'business', 'health', 'entertainment', 'sport']),
            
        ];
    }

    
}
