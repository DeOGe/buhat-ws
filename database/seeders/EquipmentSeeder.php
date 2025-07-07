<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
            [
                'name' => 'Dumbbell',
                'description' => 'A short bar with a weight at each end used typically in pairs for exercise.'
            ],
            [
                'name' => 'Barbell',
                'description' => 'A long bar with weights at each end used for weightlifting.'
            ],
            [
                'name' => 'Resistance Band',
                'description' => 'A stretchable band used for strength training and physical therapy.'
            ],
            [
                'name' => 'Treadmill',
                'description' => 'A device used for walking or running while staying in the same place.'
            ],
        ];

        foreach ($equipments as $equipment) {
            Equipment::create($equipment);
        }
    }
}
