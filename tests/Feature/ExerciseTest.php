<?php

use App\Models\Exercise;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Muscle;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

beforeEach(function () {
    Category::factory()->create(['category_id' => 1]);
    Equipment::factory()->create(['equipment_id' => 1]);
    Muscle::factory()->create(['muscle_id' => 1]);
});

it('can list exercises', function () {
    Exercise::factory()->count(3)->create();

    $response = $this->getJson('/api/exercises');

    $response->assertStatus(200)->assertJsonCount(3, 'data');
});

// 👇 Show a single exercise
it('can show a single exercise', function () {
    $exercise = Exercise::factory()->create();

    $response = $this->getJson('/api/exercises/' . $exercise->exercise_id);

    $response->assertStatus(200)
        ->assertJsonFragment(['exerciseId' => $exercise->exercise_id]);
});

// 👇 Create an exercise
it('can create an exercise', function () {
    $data = [
        'name' => 'Bench Press',
        'description' => 'Chest press',
        'category_id' => 1,
        'equipment_id' => 1,
        'muscle_id' => 1,
    ];

    $response = $this->postJson('/api/exercises', $data);

    $response->assertStatus(201)
        ->assertJsonFragment(['name' => 'Bench Press']);
});

// 👇 Update an exercise
it('can update an exercise', function () {
    $exercise = Exercise::factory()->create();

    $response = $this->putJson('/api/exercises/' . $exercise->exercise_id, [
        'name' => 'Updated Exercise',
        'description' => $exercise->description,
        'category_id' => $exercise->category_id,
        'equipment_id' => $exercise->equipment_id,
        'muscle_id' => $exercise->muscle_id,
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => 'Updated Exercise']);
});

// 👇 Delete an exercise
it('can delete an exercise', function () {
    $exercise = Exercise::factory()->create();

    $response = $this->deleteJson('/api/exercises/' . $exercise->exercise_id);

    $response->assertStatus(200)
        ->assertJson(['message' => 'Exercise deleted successfully.']);
});
