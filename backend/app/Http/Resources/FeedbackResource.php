<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return    [
            'id' => $this->id,
            'feedback' => $this->feedback,
            'student_id' => $this->student_id,
            'teacher_id' => $this->teacher_id,
            'transcript_id' => $this->transcript_id,
        ];
    }
}
