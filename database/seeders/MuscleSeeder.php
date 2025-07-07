<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Muscle;

class MuscleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $muscles = [
            [
                'name' => 'Chest',
                'description' => 'Pectoral muscles involved in pressing movements.',
            ],
            [
                'name' => 'Back',
                'description' => 'Latissimus dorsi and other upper/lower back muscles.',
            ],
            [
                'name' => 'Legs',
                'description' => 'Quadriceps, hamstrings, calves, and glutes.',
            ],
            [
                'name' => 'Shoulders',
                'description' => 'Deltoids used in lifting and pressing motions.',
            ],
            [
                'name' => 'Arms',
                'description' => 'Biceps and triceps for curling and pushing movements.',
            ],
            [
                'name' => 'Core',
                'description' => 'Abdominal muscles supporting posture and balance.',
            ],
        ];

        foreach ($muscles as $muscle) {
            Muscle::create($muscle);
        }
    }
}
