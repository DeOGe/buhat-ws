<?php

namespace Database\Factories;

use App\Models\WorkoutExercise;
use App\Models\Workout;
use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutExerciseFactory extends Factory
{
    protected $model = WorkoutExercise::class;

    public function definition(): array
    {
        return [
            'workout_id' => Workout::factory(), // assumes WorkoutFactory exists
            'exercise_id' => Exercise::factory(), // assumes ExerciseFactory exists
            'exercise_order' => $this->faker->numberBetween(1, 5),
        ];
    }
}
