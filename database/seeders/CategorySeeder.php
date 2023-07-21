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
        $bookCategories = [
            'Action and Adventure',
            'Classics',
            'Comic Book or Graphic Novel',
            'Detective and Mystery',
            'Fantasy',
            'Historical Fiction',
            'Horror',
            'Literary Fiction',
            'Romance',
            'Science Fiction (Sci-Fi)',
            'Short Stories',
            'Suspense and Thrillers',
            'Biographies and Autobiographies',
            'Cookbooks',
            'Essays',
            'History',
            'Memoir',
            'Poetry',
            'Self-Help',
            'True Crime',
        ];

        foreach ($bookCategories as $category) {
            \App\Models\Category::factory()->create([
                'name' => $category,
            ]);
        }
    }
}
