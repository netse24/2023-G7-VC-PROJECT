<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'firstName' =>$this->FirstName,
            'lastName' =>$this->LastName,
            'email' =>$this->Email,
            'password' =>$this->Password,
            'date_birth' =>$this->DateOfBirth,
            'gender' =>$this->Gender,
            'address' =>$this->Address,
            'role_id' =>$this->role,
        ];
    }
}
