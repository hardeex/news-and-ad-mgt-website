<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Delete existing categories
        Category::truncate();

        $categories = ['Nigeria', 'World', 'Politics', 'Business', 'Health', 'Remembrance', 'Memorial', 'Condolescence', 'Obituary', 
        'Politician', 'Sport', 'Technology', 
        'Lifestyle', 'Music', 'Science', 'Opinion', 'Local', 'International', 'Weather', 'Movie', 'Pride of Nigeria', 'Entertainment', 'Information', 'ideas', 'Social', 
        'Cultural', 'Awards', 'Education & Learning', 'Training', 'Community Events', 'Arts & Entertainment',
        'Communication', 'Automobile', 'Agricultural & Farming', 'Hotels', 'Government', 'Legal Services',
        'Merchant', 'Engineering', 'Events Conference', 'Energy & Utilities', 'Car Dealers', 'Artisans', 
        'Security & Emergency', 'Pet Supply', 'Schools', 'Online Influencers', 'Personal Care', 'Toursim & Hospitality',
        'Fashion & Clothing', 'Food & Restaurant', 'Companies', 'Phones & Laptop', 'Religion & Spirituality',
        'Shopping', 'Transportation', 'NGO', 'Online Courses', 'Others'];

        // Add categories if they do not exist
        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
