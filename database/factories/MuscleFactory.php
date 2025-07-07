<?php

namespace Database\Factories;

use App\Models\Muscle;
use Illuminate\Database\Eloquent\Factories\Factory;

class MuscleFactory extends Factory
{
    protected $model = Muscle::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
