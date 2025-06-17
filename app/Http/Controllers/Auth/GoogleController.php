<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(24)),
                ]
            );

            Auth::login($user);

            $token = $user->createToken('auth-token')->plainTextToken;

            // Return a JSON response containing the access token and user information.
            // This is suitable for API clients (e.g., mobile apps, SPAs).
            return response()->json([
                'user' => $user, // You might want to select specific user fields to return
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Authentication failed. Please try again.',
                'error' => $e->getMessage(), // You might remove this in production
            ], 500);
        }
    }
}
