<?php

namespace App\Http\Resources\AuthResponses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogoutResponse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Logged out successfully.',
            'status' => true,
        ];
    }
}
