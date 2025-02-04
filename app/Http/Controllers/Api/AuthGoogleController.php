<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google\Client as GoogleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthGoogleController extends Controller
{
    public function callback(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        try {
            $client = new GoogleClient;
            $client->setApplicationName('Peated Laravel');
            $client->setClientId(config('services.google.client_id'));
            $client->setClientSecret(config('services.google.client_secret'));
            $client->setRedirectUri('postmessage');

            $token = $client->fetchAccessTokenWithAuthCode($request->code);

            if (! isset($token['id_token'])) {
                return response()->json([
                    'message' => 'Unable to validate credentials.',
                ], 401);
            }

            $payload = $client->verifyIdToken($token['id_token']);

            if (! $payload || ! isset($payload['email'])) {
                return response()->json([
                    'message' => 'Unable to validate credentials.',
                ], 401);
            }

            // Find user by Google identity
            $user = User::whereHas('identities', function ($query) use ($payload) {
                $query->where('provider', 'google')
                    ->where('external_id', $payload['sub']);
            })->first();

            if (! $user) {
                // Try to find user by email
                $user = User::where('email', strtolower($payload['email']))->first();

                if ($user) {
                    // Associate Google identity with existing user
                    $user->identities()->create([
                        'provider' => 'google',
                        'external_id' => $payload['sub'],
                    ]);
                } else {
                    // Create new user
                    $user = DB::transaction(function () use ($payload) {
                        $user = User::create([
                            'username' => strtolower(explode('@', $payload['email'])[0]),
                            'email' => $payload['email'],
                            'email_verified_at' => now(),
                        ]);

                        $user->identities()->create([
                            'provider' => 'google',
                            'external_id' => $payload['sub'],
                        ]);

                        return $user;
                    });
                }
            }

            if (! $user->active) {
                return response()->json([
                    'message' => 'Unable to validate credentials.',
                ], 401);
            }

            return response()->json([
                'user' => $user->load('preferences'),
                'access_token' => $user->createToken('google-auth')->plainTextToken,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unable to validate credentials.',
            ], 401);
        }
    }
}
