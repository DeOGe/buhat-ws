<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkoutExercise;
use App\Models\Set;

class SetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure there is at least one WorkoutExercise to attach sets to
        $workoutExercise = WorkoutExercise::first();

        if (!$workoutExercise) {
            $this->command->warn('No workout_exercises found. Run WorkoutExerciseSeeder first.');
            return;
        }

        $sets = [
            [
                'workout_exercise_id' => $workoutExercise->workout_exercise_id,
                'set_number' => 1,
                'reps' => 10,
                'weight' => '50',
                'time' => '00:30',
                'distance' => '0',
                'notes' => 'Warm-up set',
            ],
            [
                'workout_exercise_id' => $workoutExercise->workout_exercise_id,
                'set_number' => 2,
                'reps' => 8,
                'weight' => '60',
                'time' => '00:30',
                'distance' => '0',
                'notes' => 'Moderate intensity',
            ],
            [
                'workout_exercise_id' => $workoutExercise->workout_exercise_id,
                'set_number' => 3,
                'reps' => 6,
                'weight' => '70',
                'time' => '00:30',
                'distance' => '0',
                'notes' => 'Heavy set',
            ],
        ];

        foreach ($sets as $set) {
            Set::create($set);
        }
    }
}
