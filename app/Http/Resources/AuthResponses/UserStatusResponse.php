<?php

namespace App\Http\Resources\AuthResponses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStatusResponse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'is_active' => (bool) $this->is_active,
            'status_message' => $this->is_active ? 'User activated successfully' : 'User deactivated successfully',
        ];
    }
}
