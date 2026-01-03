<?php

namespace App\Http\Resources\v1\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $profile = $this->employeeProfile;
        return [
            'id' => $this->id,
            'full_name' => trim($profile?->first_name. ' ' .$profile?->last_name),
            'phone' => $this->phone,
            'email' => $this->email,
            'role' => $this->roles()->first()?->name,
        ];
    }
}
