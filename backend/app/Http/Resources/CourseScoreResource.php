<?php

namespace App\Http\Resources;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'course' => $this->course->course,
            'score' => $this->score,
            'term' => $this->term->term
        ];

    }
}
