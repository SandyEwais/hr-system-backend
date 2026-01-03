<?php

namespace App\Http\Resources\v1\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterationResource extends JsonResource
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
            'first_name' => $profile?->first_name,
            'last_name' => $profile?->last_name,
            'gender' => $profile?->gender,
            'username' => $this->username,
            'email' => $this->email,
            'nationality' => $profile?->nationality,
            'project_id' => $profile?->project_id,
            'phone' => $this->phone,
            'date_of_birth' => $profile?->date_of_birth,
        ];
    }
}
