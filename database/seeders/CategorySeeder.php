<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest technology news and updates',
                'color' => '#3B82F6',
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business and entrepreneurship content',
                'color' => '#10B981',
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Lifestyle and personal development',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Health',
                'slug' => 'health',
                'description' => 'Health and wellness articles',
                'color' => '#EF4444',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
