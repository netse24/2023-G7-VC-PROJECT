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
<<<<<<< HEAD
            'first_name' =>$this->first_name,
            'last_name' =>$this->last_name,
            'email' =>$this->email,
            // 'password' =>$this->password,
            'date_of_birth' =>$this->date_of_birth,
            'gender' =>$this->gender,
            'address' =>$this->address,
            'role' =>$this->role->name,
=======
            'firstName' =>$this->FirstName,
            'lastName' =>$this->LastName,
            'email' =>$this->Email,
            'password' =>$this->Password,
            'date_birth' =>$this->DateOfBirth,
            'gender' =>$this->Gender,
            'address' =>$this->Address,
            'role_id' =>$this->role,
>>>>>>> e91a672f0103173d97b8498441449e64dfed80a6
        ];
    }
}
