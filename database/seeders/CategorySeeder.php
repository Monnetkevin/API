<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['category_name' => 'Restaurant'],
            ['category_name' => 'Parc'],
            ['category_name' => 'Loisir'],
            ['category_name' => 'Balade'],
            ['category_name' => 'Musé ou Monument'],
            ['category_name' => 'Spectacle'],
            ['category_name' => 'Autre'],
        ];

        foreach ($category as $categoryData) {
            Category::create($categoryData);
        }
    }
}
