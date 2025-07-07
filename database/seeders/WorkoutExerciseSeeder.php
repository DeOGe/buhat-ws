<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workout;
use App\Models\Exercise;
use App\Models\WorkoutExercise;

class WorkoutExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workout = Workout::first();
        $exercises = Exercise::take(3)->get(); // Use 3 example exercises

        if (!$workout || $exercises->isEmpty()) {
            $this->command->warn('Missing workouts or exercises. Seed those first.');
            return;
        }

        foreach ($exercises as $index => $exercise) {
            WorkoutExercise::create([
                'workout_id' => $workout->workout_id,
                'exercise_id' => $exercise->exercise_id, // or $exercise->id if that's your primary key
                'exercise_order' => $index + 1,
            ]);
        }
    }
}
