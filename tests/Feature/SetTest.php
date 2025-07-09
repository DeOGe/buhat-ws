<?php

use App\Models\Set;
use App\Models\User;
use App\Models\WorkoutExercise;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Ensure related record exists
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'sanctum');
    $this->workoutExercise = WorkoutExercise::factory()->create();
});

it('can list sets', function () {
    Set::factory()->count(3)->create(['workout_exercise_id' => $this->workoutExercise->workout_exercise_id]);

    $response = $this->getJson('/api/sets');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

it('can show a set', function () {
    $set = Set::factory()->create(['workout_exercise_id' => $this->workoutExercise->workout_exercise_id]);

    $response = $this->getJson("/api/sets/{$set->set_id}");

    $response->assertStatus(200)
        ->assertJsonFragment(['setId' => $set->set_id]);
});

it('can create a set', function () {
    $workoutExercise = \App\Models\WorkoutExercise::factory()->create();

    $data = [
        'workout_exercise_id' => $workoutExercise->workout_exercise_id,
        'set_number' => 1,
        'reps' => 12,
        'weight' => '60',
        'time' => '00:30',
        'distance' => '0',
        'notes' => 'Test set',
    ];

    $response = $this->postJson('/api/sets', $data);

    $response->assertStatus(201)
        ->assertJsonFragment(['notes' => 'Test set']);
});

it('can update a set', function () {
    $set = Set::factory()->create(['workout_exercise_id' => $this->workoutExercise->workout_exercise_id]);

    $response = $this->putJson("/api/sets/{$set->set_id}", ['notes' => 'Updated note']);

    $response->assertStatus(200)
        ->assertJsonFragment(['notes' => 'Updated note']);
});

it('can delete a set', function () {
    $set = Set::factory()->create(['workout_exercise_id' => $this->workoutExercise->workout_exercise_id]);

    $response = $this->deleteJson("/api/sets/{$set->set_id}");

    $response->assertNoContent();
});
