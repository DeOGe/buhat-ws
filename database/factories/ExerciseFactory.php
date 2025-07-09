<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\Muscle;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'description' => $this->faker->paragraph,
            'category_id' => Category::factory(),
            'equipment_id' => Equipment::factory(),
            'muscle_id' => Muscle::factory(),
            'video_url' => $this->faker->url,
        ];
    }
}
