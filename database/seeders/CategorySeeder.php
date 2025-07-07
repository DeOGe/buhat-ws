<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Strength',
                'description' => 'Exercises focused on building muscle strength.'
            ],
            [
                'name' => 'Cardio',
                'description' => 'Exercises that improve cardiovascular health.'
            ],
            [
                'name' => 'Flexibility',
                'description' => 'Exercises to improve flexibility and range of motion.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
