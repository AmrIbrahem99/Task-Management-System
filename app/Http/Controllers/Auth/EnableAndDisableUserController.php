<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\ToggleUserStatusRequest;
use App\Http\Resources\AuthResponses\UserStatusResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class EnableAndDisableUserController extends Controller
{
    public function __invoke(ToggleUserStatusRequest $request, User $user): JsonResponse
    {
        //prevent user from disabling themselves
        if ($user->id === auth()->id()) {
            return response()->json([
                'message' => 'You cannot disable yourself.'
            ], 400);
        }

        $user->is_active = !$user->is_active;

        $user->save();

        return response()->json(new UserStatusResponse($user));
    }
}

