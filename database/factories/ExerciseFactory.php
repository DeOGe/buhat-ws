<?php

namespace Database\Factories;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
{
    protected $model = Exercise::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'category_id' => \App\Models\Category::factory(),
            'equipment_id' => \App\Models\Equipment::factory(),
            'muscle_id' => \App\Models\Muscle::factory(),
        ];
    }
}
