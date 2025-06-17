<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

uses(RefreshDatabase::class);

it('shows the authenticated user profile', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'google_id' => 'test-google-id',
        'avatar' => 'https://example.com/avatar.png',
        'weight' => 65,
        'height' => 170,
        'gender' => 'male',
        'date_of_birth' => '1990-01-01',
    ]);

    $response = $this->actingAs($user, 'sanctum')
        ->getJson('/api/my/profile');

    $response->assertOk()
        ->assertJson([
            'data' => [
                'userId' => $user->id,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'googleId' => 'test-google-id',
                'avatar' => 'https://example.com/avatar.png',
                'weight' => 65,
                'height' => 170,
                'gender' => 'male',
                'dateOfBirth' => '1990-01-01',
                'createdAt' => Carbon::parse($user->created_at)->format('F d, Y h:i A'),
                'updatedAt' => Carbon::parse($user->updated_at)->format('F d, Y h:i A'),
            ]
        ]);
});


it('updates the authenticated user profile with partial data', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'google_id' => 'test-google-id',
    ]);

    $payload = [
        'name' => 'Updated Name',
        'weight' => 70,
    ];

    $response = $this->actingAs($user, 'sanctum')
        ->putJson('/api/update/profile', $payload); // Make sure this is the correct route

    $response->assertOk()
        ->assertJsonFragment([
            'name' => 'Updated Name',
            'weight' => 70,
        ]);

    expect($user->fresh()->name)->toBe('Updated Name');
    expect($user->fresh()->weight)->toBe('70');
});


it('does not allow unauthenticated user to access profile', function () {
    $this->getJson('/api/my/profile')->assertUnauthorized();
    $this->putJson('/api/update/profile', [])->assertUnauthorized();
});
