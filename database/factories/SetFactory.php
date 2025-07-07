<?php

namespace Database\Factories;

use App\Models\Set;
use App\Models\WorkoutExercise;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetFactory extends Factory
{
    protected $model = Set::class;

    public function definition(): array
    {
        return [
            'workout_exercise_id' => WorkoutExercise::factory(),
            'set_number' => $this->faker->numberBetween(1, 5),
            'reps' => $this->faker->numberBetween(5, 15),
            'weight' => $this->faker->randomFloat(1, 20, 100),
            'time' => $this->faker->time('i:s'),
            'distance' => $this->faker->randomFloat(1, 0, 5),
            'notes' => $this->faker->sentence(),
        ];
    }
}
