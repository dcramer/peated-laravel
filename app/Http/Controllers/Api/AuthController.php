<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Authenticated user failed to retrieve details'
            ], 500);
        }

        if (!$user->active) {
            return response()->json([
                'message' => 'User account is not active'
            ], 500);
        }

        return new UserResource($user);
    }
}
