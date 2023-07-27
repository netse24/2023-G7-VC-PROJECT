<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
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
            'term_id' => $this->id,
            'term' => $this-> term
=======
            'id' =>$this->id,
            'term' => $this->term
>>>>>>> b549d9748acb31695635b9f5e4972a9e5d464167
        ];
    }
}
