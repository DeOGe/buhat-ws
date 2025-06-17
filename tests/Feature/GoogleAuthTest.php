<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use App\Models\User;
use Illuminate\Support\Str;
use Mockery;

uses(RefreshDatabase::class);

beforeEach(function () {
    Config::set('services.google', [
        'client_id' => 'mock_client_id',
        'client_secret' => 'mock_client_secret',
        'redirect' => 'http://localhost/auth/google/callback', // Ensure this matches your routes/api.php or routes/web.php
    ]);

    Socialite::spy(); // Clears and sets up a fresh mock for each test
});

it('redirects to google for authentication', function () {
    // Set the expectation directly on the Socialite facade
    Socialite::shouldReceive('driver')
        ->with('google')
        ->andReturn(
            Mockery::mock(\Laravel\Socialite\Two\GoogleProvider::class)
                ->shouldReceive('stateless') // <--- ADD THIS LINE to expect stateless()
                ->andReturnSelf()            // <--- ADD THIS LINE to allow chaining
                ->shouldReceive('redirect')
                ->andReturn(redirect('https://accounts.google.com/o/oauth2/auth'))
                ->getMock()
        );

    // Ensure your route matches what's in routes/api.php
    $response = $this->get('/auth/google');

    $response->assertRedirect('https://accounts.google.com/o/oauth2/auth');
});

// The following tests for 'can register new user', 'can log in existing user',
// and 'handles google callback errors' should already have the `stateless()->andReturnSelf()->user()` chain,
// so they should be fine. I'll include one example for completeness.

it('can register a new user via google callback and issue sanctum token', function () {
    $mockGoogleUser = new SocialiteUser();
    $mockGoogleUser->id = 'google_id_123';
    $mockGoogleUser->name = 'John Doe';
    $mockGoogleUser->email = 'john.doe@example.com';
    $mockGoogleUser->avatar = 'https://example.com/avatar.jpg';
    $mockGoogleUser->token = Str::random(40);
    $mockGoogleUser->refreshToken = Str::random(40);

    Socialite::shouldReceive('driver')
        ->with('google')
        ->andReturn(
            Mockery::mock(\Laravel\Socialite\Two\GoogleProvider::class)
                ->shouldReceive('stateless')
                ->andReturnSelf()
                ->shouldReceive('user')
                ->andReturn($mockGoogleUser)
                ->getMock()
        );

    $response = $this->get('/auth/google/callback');

    $this->assertDatabaseHas('users', [
        'email' => 'john.doe@example.com',
        'google_id' => 'google_id_123',
        'name' => 'John Doe',
    ]);

    expect(Auth::check())->toBeTrue();
    expect(Auth::user()->email)->toBe('john.doe@example.com');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'google_id',
                'avatar',
            ],
            'access_token',
            'token_type',
        ]);

    expect($response->json('access_token'))->not->toBeEmpty();
    expect($response->json('token_type'))->toBe('Bearer');

    $user = User::where('email', 'john.doe@example.com')->first();
    expect($user->tokens()->count())->toBe(1);
    expect($user->tokens->first()->name)->toBe('auth-token');
});


it('can log in an existing user via google callback and issue sanctum token', function () {
    $existingUser = User::factory()->create([
        'name' => 'Existing User',
        'email' => 'existing.user@example.com',
        'google_id' => null,
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
    ]);

    $mockGoogleUser = new SocialiteUser();
    $mockGoogleUser->id = 'google_id_existing';
    $mockGoogleUser->name = 'Existing User Updated';
    $mockGoogleUser->email = 'existing.user@example.com';
    $mockGoogleUser->avatar = 'https://example.com/existing_avatar.jpg';
    $mockGoogleUser->token = Str::random(40);
    $mockGoogleUser->refreshToken = Str::random(40);

    Socialite::shouldReceive('driver')
        ->with('google')
        ->andReturn(
            Mockery::mock(\Laravel\Socialite\Two\GoogleProvider::class)
                ->shouldReceive('stateless')
                ->andReturnSelf()
                ->shouldReceive('user')
                ->andReturn($mockGoogleUser)
                ->getMock()
        );

    // Change to /api/auth/google/callback
    $response = $this->get('/auth/google/callback');

    $this->assertDatabaseHas('users', [
        'email' => 'existing.user@example.com',
        'google_id' => 'google_id_existing',
        'name' => 'Existing User Updated',
    ]);

    expect(Auth::check())->toBeTrue();
    expect(Auth::user()->email)->toBe('existing.user@example.com');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'google_id',
                'avatar',
            ],
            'access_token',
            'token_type',
        ]);

    expect($response->json('access_token'))->not->toBeEmpty();
    expect($response->json('token_type'))->toBe('Bearer');

    $user = User::where('email', 'existing.user@example.com')->first();
    expect($user->tokens()->count())->toBe(1);
});

it('handles google callback errors gracefully', function () {
    Socialite::shouldReceive('driver')
        ->with('google')
        ->andReturn(
            Mockery::mock(\Laravel\Socialite\Two\GoogleProvider::class)
                ->shouldReceive('stateless')
                ->andReturnSelf()
                ->shouldReceive('user')
                ->andThrow(new \Exception('Google authentication failed.'))
                ->getMock()
        );

    // Change to /api/auth/google/callback
    $response = $this->get('/auth/google/callback');

    $this->assertDatabaseCount('users', 0);

    expect(Auth::check())->toBeFalse();

    $response->assertStatus(500)
        ->assertJson([
            'message' => 'Authentication failed. Please try again.',
        ]);
});
