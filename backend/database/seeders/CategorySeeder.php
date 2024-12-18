<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data dummy untuk kategori
        $categories = [
            ['name' => 'Sci-Fi', 'slug' => 'sci-fi'],
            ['name' => 'Action', 'slug' => 'action'],
            ['name' => 'Drama', 'slug' => 'drama'],
            ['name' => 'Adventure', 'slug' => 'adventure'],
            ['name' => 'Comedy', 'slug' => 'comedy'],
            ['name' => 'Horror', 'slug' => 'horror'],
            ['name' => 'Romance', 'slug' => 'romance'],
        ];

        // Masukkan data ke database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
