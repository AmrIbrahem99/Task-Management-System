<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\LogoutRequest;
use App\Http\Resources\AuthResponses\LogoutResponse;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    public function __invoke(LogoutRequest $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(new LogoutResponse(null));
    }
}
