<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Muscle;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();    // or use specific logic to pick one
        $equipment = Equipment::first();
        $muscle = Muscle::first();

        $exercises = [
            [
                'name' => 'Push-Up',
                'description' => 'A bodyweight exercise for upper body strength.',
                'category_id' => $category?->id,
                'equipment_id' => null,
                'muscle_id' => $muscle?->id,
                'video_url' => 'https://example.com/pushup.mp4',
            ],
            [
                'name' => 'Barbell Squat',
                'description' => 'A strength exercise targeting the legs and glutes.',
                'category_id' => $category?->id,
                'equipment_id' => $equipment?->id,
                'muscle_id' => $muscle?->id,
                'video_url' => 'https://example.com/squat.mp4',
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
