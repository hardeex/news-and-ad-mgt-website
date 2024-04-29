<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsPost;
use Faker\Factory as Faker;



use Illuminate\Support\Str;

class NewsPostSeeder extends Seeder
{
    public function run()
    {
        // Define categories
        $categories = ['Nigeria', 'World', 'Politics', 'Business', 'Health', 'Remembrance', 'Memorial', 'Condolescence', 'Obituary', 
        'Politician', 'Sport', 'Technology', 
        'Lifestyle', 'Music', 'Science', 'Opinion', 'Local', 'International', 'Weather', 'Movie', 'Pride of Nigeria', 'Entertainment', 'Information', 'ideas', 'Social', 
        'Cultural', 'Awards', 'Education & Learning', 'Training', 'Community Events', 'Arts & Entertainment',
        'Communication', 'Automobile', 'Agricultural & Farming', 'Hotels', 'Government', 'Legal Services',
        'Merchant', 'Engineering', 'Events Conference', 'Energy & Utilities', 'Car Dealers', 'Artisans', 
        'Security & Emergency', 'Pet Supply', 'Schools', 'Online Influencers', 'Personal Care', 'Toursim & Hospitality',
        'Fashion & Clothing', 'Food & Restaurant', 'Companies', 'Phones & Laptop', 'Religion & Spirituality',
        'Shopping', 'Transportation', 'NGO', 'Online Courses', 'Others'];

        // Create fake posts
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            NewsPost::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'image' => $faker->imageUrl(),
                'is_featured' => $faker->boolean,
                'is_trending' => $faker->boolean,
                'is_headline' => $faker->boolean,
                'category' => $categories[array_rand($categories)], 
                'top_topic' => $faker->boolean,
                'deceased_name' => $faker->name,
                'age' => $faker->numberBetween(18, 100),
            ]);
        }
    }
}