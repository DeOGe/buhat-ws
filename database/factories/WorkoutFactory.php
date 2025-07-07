<?php

namespace Database\Factories;

use App\Models\Workout;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WorkoutFactory extends Factory
{
    protected $model = Workout::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Assumes UserFactory exists
            'workout_date' => Carbon::today(),
            'start_time' => '08:00:00',
            'end_time' => '09:00:00',
            'notes' => $this->faker->sentence(),
        ];
    }
}
