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
<<<<<<< HEAD
            'id' =>$this->id,
            'first_name' =>$this->first_name,
            'last_name' =>$this->last_name,
            'email' =>$this->email,
            'password' =>$this->password,
            'date_of_birth' =>$this->date_of_birth,
            'gender' =>$this->gender,
            'address' =>$this->address,
            'role' =>$this->role->name,
            'role_id' =>$this->role,

=======
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'address' => $this->address,
            'role_id' => new RoleResource($this->role),
>>>>>>> f12a6829500a8b66e0f3128e2a88a0c31aa9a70e
        ];
    }   
}