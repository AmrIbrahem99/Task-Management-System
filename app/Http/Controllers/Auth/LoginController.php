<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Resources\AuthResponses\LoginResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

        function __invoke(LoginRequest $request): JsonResponse
        {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials',
                ], 401);
            }
            if (!$user->is_active) {
                return response()->json([
                    'message' => 'User is disabled',
                ], 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(
                new LoginResponse(
                    (object)[
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'token' => $token,
                    ]
                )
            );
        }
}
